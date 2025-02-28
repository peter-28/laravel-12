$(document).ready(function () {
    displayData();
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

const getUrl = () => {
    let url = window.location.href;
    let arr = url.split("/");
    let data = arr[3];
    return data;
};

const data = getUrl();
console.log(data);

function displayData(id = null, data_search = null, type = null) {
    $.ajax({
        url: `/master-data/${data}/create`,
        method: "get",
        success: async function (response) {
            await $(`#show-data-${data}`).html(response);
            $(`#row-${data}-${id}`).addClass("success-alert");
            setTimeout(() => {
                $(`#row-${data}-${id}`).removeClass("success-alert");
            }, 3000);
            $(`#table-${data}`).DataTable();
        },
        error: function (err) {
            console.log(err);
        },
    });
}

function openModal(data, type, id = null) {
    if (type == "add") {
        $(`#modal-${data}`).modal("show");
    } else if (type == "edit") {
        $(`#modal-${data}`).modal("show");
        modalType = type;
    } else if (type == "detail") {
        $(`#modal-detail-${data}`).modal("show");
    }

    switch (type) {
        case "add":
            $(`#form-${data}`)[0].reset();
            $(`#add-${data}`).show();
            $(`#edit-${data}`).hide();
            $.ajax({
                url: `/master-data/${data}/code`,
                method: "get",
                dataType: "json",
                success: async function (response) {
                    console.log(response);
                },
                error: function (err) {
                    console.log(err);
                },
            });
            break;
        case "edit":
            $(`#form-${data}`)[0].reset();
            $(`#edit-${data}`).show();
            $(`#add-${data}`).hide();
            $.ajax({
                url: `/master-data/${data}/${id}/edit`,
                method: "get",
                dataType: "json",
                success: async function (response) {
                    console.log(response);
                },
                error: function (err) {
                    console.log(err);
                },
            });
            break;
        case "detail":
            $.ajax({
                url: `/admin/master-data/${data}/${id}/edit`,
                method: "get",
                dataType: "json",
                success: async function (response) {
                    console.log(response);
                },
                error: function (err) {
                    console.log(err);
                },
            });
            break;
    }
}

const successResponse = (type, data, message, id = null) => {
    $(`#modal-${data}`).modal("hide");
    $(`#form-${data}`)[0].reset();
    $(`#form-${data}`).unbind("submit");
    displayData(id);

    Toast.fire({
        icon: "success",
        title: message,
    });
    switch (type) {
        case "add":
            $(`#add-${data}`).removeAttr("disabled");
            break;
        default:
            break;
    }
};

function manageData(type, id = null) {
    switch (type) {
        case "save":
            $(`#form-${data}`).submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: `/master-data/${data}`,
                    type: "post",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: async function (response) {
                        await successResponse(
                            "add",
                            data,
                            response.message,
                            response.data.id
                        );
                    },
                    error: async function (err) {
                        console.log(err);
                        let err_log = err.responseJSON.errors;
                        await handleError(err, err_log, data);
                    },
                });
            });
            break;
        case "update":
            id = $("#id").val();
            $(`#form-${data}`).submit(function (e) {
                e.preventDefault();
                let formData = $(`#form-${data}`).serialize();
                $.ajax({
                    url: `/master-data/${data}/${id}`,
                    type: "patch",
                    data: formData,
                    dataType: "json",
                    success: async function (response) {
                        await successResponse(
                            "edit",
                            data,
                            response.message,
                            response.data.id
                        );
                    },
                    error: async function (err) {
                        let err_log = err.responseJSON.errors;
                        await handleError(err, err_log, data);
                    },
                });
            });
            break;
        case "delete":
            Swal.fire({
                title: "Yakin akan menghapus data?",
                text: "Data yang di hapus tidak dapat dikembalikan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/master-data/${data}/${id}`,
                        method: "delete",
                        success: function (response) {
                            console.log(response);
                            if (response.status == 300) {
                                Toast.fire({
                                    icon: "error",
                                    title: response.message,
                                });
                                return;
                            }

                            successResponse(
                                "delete",
                                data,
                                response.message,
                                response.data
                            );
                        },
                        error: function (err) {
                            console.log(err);
                        },
                    });
                }
            });
            break;
        default:
            break;
    }
}

function handleError(err, err_log, type) {
    $(`#add-${data}`).removeAttr("disabled");
    $(`#form-${data}`).unbind("submit");
    switch (type) {
        case "status":
            if (err.status == 422) {
                if (typeof err_log.status_name !== "undefined") {
                    Toast.fire({
                        icon: "error",
                        title: err_log.status_name[0],
                    });
                }
                if (typeof err_log.status_code !== "undefined") {
                    Toast.fire({
                        icon: "error",
                        title: err_log.status_code[0],
                    });
                }
            } else {
                Toast.fire({
                    icon: "error",
                    title: "Terjadi Kesalahan Pada Sistem",
                });
            }
            break;
    }
}

function fetchData(data, response, type = null) {
    switch (data) {
        case "departement":
            $("#id").val(response.id);
            $("#code").val(response.code);
            $("#name").val(response.name);
            $("#description").val(response.description);
    }
}
