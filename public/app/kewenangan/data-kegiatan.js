/**
 * Created by Edi Santoso on 6/16/2014.
 * @email : edicyber@gmail.com
 */
var token = "&_token=" + $("input[name=_token]").val();
// onReady
$(document).ready(function () {
    $("#li-struktur").attr("style", "display:block;");
    $("#a-struktur").addClass("active");
    $("#li-perangkat").attr("style", "display:block;");
    $("#a-perangkat").addClass("active");
    $("#menu-kewenangan").addClass("active");
    $("#mundur").attr('disabled', 'disabled');
    $("#alert-notify").hide();
    var current_page = $("#current_page").val();
    var to = $("#to").val();
    var total = $("#total").val();
    if(total == 0){
        $("#infopage").text('0 - ' + to + ' dari ' + total);
    } else {
        $("#infopage").text(current_page + ' - ' + to + ' dari ' + total);
    }
    // handle pagination
    if (total > 10) {
        $("#maju").removeAttr('disabled');
        $("#akhir").removeAttr('disabled');
    }
    $("#bidang_id").attr('disabled', 'disabled');
    // ketika ada event enter untuk pencarian
    $("#cari").keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            TampilData(1);
        }
    }).focus();
    $("#btn-tambah").click(function (event) {
        TombolTambah();
    });
    $("#btn-batal").click(function (event) {
        TombolBatal();
    });
});
// ajax menampilkan data
function TampilData(page) {
    OpenLoading();
    var term = $("#cari").val();
    $.ajax({
        type: "post",
        url: url + "/read?page=" + page,
        cache: false,
        data: 'term=' + term + token,
        success: function (data) {
            switch (data.Status) {
                case "Warning":
                    resultWarning(data);
                    break;
                case "Logout":
                    CekAuth(data);
                    break;
                default:
                    resultData(data);
            }
        },
        error: function (data) {
            ErrMsg()
        }
    });
}
function resultData(data) {
    var obj = json2array(data);
    $("#datalist").html("");
    if (obj[6].length == 0) {
        $("#datalist").append("<tr><td colspan='" + $("tbody > tr > th").length + "'>Data kosong.</td></tr>");
    } else {
        $.each(obj[6], function (index, val) {
            $("#datalist").append(
                "<tr><td>" + val.kode_rekening + "</td>" +
                "<td>" + val.program.program + "</td>" +
                "<td>" + val.kegiatan + "</td>" +
                "<td><div class='btn-toolbar'>" +
                "<button title='Edit' class='btn btn-sm btn-default' onclick='EditData(" + val.id + ")'><i class='fa fa-edit' ></i></button>" +
                "<button title='Hapus' class='btn btn-sm btn-danger ' onclick='HapusData(" + val.id + ")'><i class='fa fa-trash-o' ></i></button>" +
                "</div>" +
                "</td></tr>"
            )
        });
        methodPagination(obj);
    }
    CloseLoading();
    $("#cari").focus();
}
function SimpanData() {
    OpenSpinner();
    $.ajax({
        url: url,
        type: 'POST',
        data: $("#myForm").serialize()
    }).done(function (data) {
        $("#alert-notify").show().html("");
        switch (data.Status) {
            case "Sukses":
                resultSuccess(data);
                TombolBatal();
                break;
            case "Warning":
                resultWarning(data);
                break;
            case "Logout":
                CekAuth(data);
                break;
            case "Validation":
                resultValidation(data);
                break;
        }
    }).fail(function (data) {
        ErrMsg()
    })
}
function EditData(id) {
    OpenLoading();
    $.ajax({
        type: "get",
        url: url + "/" + id + "/edit",
        cache: false,
        data: 'id=' + id + token,
        success: function (data) {
            switch (data.Status) {
                case "Warning":
                    resultWarning(data);
                    break;
                case "Logout":
                    CekAuth(data);
                    break;
                default:
                    dataSuccess(data);
            }
        },
        error: function () {
            ErrMsg()
        }
    });
}
function dataSuccess(data) {
    // siapkan ajax
    TombolTambah();
    getBidang(data.fungsi_id);
    getProgram(data.bidang_id);
    setTimeout(function () {
        // set atribut
        $("#cmd").val('update');
        $("#btnSimpan").text("Update");
        // inject data
        $("#id").val(data.id);
        $("#fungsi_id").val(data.fungsi_id);
        $("#bidang_id").val(data.bidang_id);
        $("#program_id").val(data.program_id);
        $("#program").val(data.program);
        $("#kode_rekening").val(data.kode_rekening);
        $("#kegiatan").val(data.kegiatan);
        $("option:selected").attr('selected', 'selected');
    }, 1500);
    CloseLoading();
}
function UpdateData() {
    OpenSpinner();
    $("#btnSimpan").attr('disabled', 'disabled');
    var id = $("#id").val();
    $.ajax({
        url: url + "/" + id,
        type: 'post',
        data: '_method=put&' + $("#myForm").serialize()
    }).done(function (data) {
        CekAuth(data);
        $("#alert-notify").show().html("");
        switch (data.Status) {
            case "Sukses":
                resultSuccess(data);
                TombolBatal();
                break;
            case "Warning":
                resultWarning(data);
                break;
            case "Validation":
                resultValidation(data);
                break;
        }
    }).fail(function () {
        ErrMsg()
    })
}
function HapusData(id) {
    $("#modalHapus").modal('show');
    $('#id_hapus').val(id);
}
function AksiHapus() {
    OpenLoading();
    var id = $('#id_hapus').val();
    $.ajax({
        type: "post",
        url: url + "/" + id,
        cache: false,
        data: '_method=delete' + token,
        success: function (data) {
            CekAuth(data);
            var data = json2array(data);
            $("#alert-notify").text("").show();
            if ("Warning" == data[0]) {
                for (var i = 1; i < data.length; i++) {
                    $("#alert-notify").removeClass('alert-success').addClass('alert-danger').append("<ul style='margin-bottom: 0px;'>" + data[i] + "</ul>");
                }
            } else {
                $("#alert-notify").removeClass('alert-danger').addClass('alert-success').append("<ul>" + data[1] + "</ul>").fadeOut(1000);
                $("#datalist").html("");
                TampilData($("#current_page").val());
                CloseLoading();
            }
            $("#modalHapus").modal('hide');
        },
        error: function () {
            ErrMsg()
        }
    });
}
function TombolBatal() {
    // kosongkan
    $("#id").val("");
    // hide
    $("#myForm").hide();
    $("#alert-notify").fadeOut(3000);
    // set atribut
    $("#cmd").val('tambah');
    $("label.error").hide();
    // remove class error
    $("#fungsi_id").html("").removeClass('error');
    $("#bidang_id").html("").removeClass('error').attr('disabled', 'disabled');
    $("#program_id").html("");
    $("#program").html("").removeClass('error').attr('disabled', 'disabled');
    $("#kode_rekening").val("").removeClass('error');
    $("#kegiatan").val("").removeClass('error');
    // show
    $("#form-cari").show();
    $("#form-option").show();
    $("#tab-content").show();
    // ajax data
    TampilData(1);
}
function TombolTambah() {
    // kosongkan data html
    // set ajax data
    getFungsi();
    // hide
    $("#form-option").hide();
    $("#tab-content").hide();
    $("#form-cari").hide();
    // show
    $("#myForm").show();
    // focused
    $("#fungsi_id").focus();
}
//Validasi
$(function () {
    $("#myForm").validate({
        submitHandler: function (form) {
            if ("tambah" == $("#cmd").val()) {
                SimpanData()
            } else if ("update" == $("#cmd").val()) {
                UpdateData()
            }
        },
        errorElement: "label",
        errorPlacement: function (e, t) {
            var n = t.parent();
            n.is(".form-group") ? e.appendTo(n) : e.appendTo(n.parent());
            e.addClass("error control-label")
        },
        rules: {
            fungsi_id: 'required',
            program_id: 'required',
            kode_rekening: 'required',
            kegiatan: 'required'
        },
        messages: {
            fungsi_id: "Silahkan pilih Fungsi",
            program_id: "Silahkan pilih program",
            kode_rekening: "Silahkan isi kode rekening",
            kegiatan: "Silahkan isi kegiatan"
        }
    })
});
function getFungsi() {
    $.ajax({
        type: "get",
        url: "ajax-list-fungsi",
        success: function (data) {
            $("#fungsi_id").append("<option value=''>Pilih Fungsi</option>")
            $.each(data, function (index, val) {
                if (val == val.id) {
                    $("#fungsi_id").append("<option value='" + val.id + "' selected='selected'>" + val.fungsi + "</option>")
                } else {
                    $("#fungsi_id").append("<option value='" + val.id + "'>" + val.fungsi + "</option>")
                }
            });
        },
        error: function (data) {}
    });
}
$(function () {
    $("#fungsi_id").change(function () {
        var fungsi_id = $(this).val();
        getBidang(fungsi_id);
    });
});
$(function () {
    $("#bidang_id").change(function () {
        var bidang_id = $(this).val();
        getProgram(bidang_id);
    });
});
function getBidang(fungsi_id) {
    $.ajax({
        type: "post",
        url: "ajax-list-bidang",
        data: 'fungsi_id=' + fungsi_id,
        success: function (data) {
            if (data == "") {
                $("#bidang_id").attr("disabled", "disabled").html("").append("<option value=''> Data kosong</option>");
            } else {
                $("#bidang_id").removeAttr('disabled').html("").append("<option value=''> Pilih Bidang</option>");
                $.each(data, function (index, val) {
                    $("#bidang_id").append("<option value='" + val.id + "'>" + val.bidang + "</option>")
                });
            }
        },
        error: function (data) {}
    });
}
function getProgram(bidang_id) {
    $.ajax({
        type: "post",
        url: "ajax-list-program-kewenangan",
        data: 'bidang_id=' + bidang_id,
        success: function (data) {
            if (data == "") {
                $("#program").attr("disabled", "disabled").html("").append("<option value=''> Data kosong</option>");
            } else {
                $("#program").removeAttr('disabled').html("").append("<option value=''> Pilih Program</option>");
                $.each(data, function (index, val) {
                    $("#program").append("<option value='" + val.id + '|' + val.kode_rekening + "'>" + val.program + "</option>")
                });
            }
        },
        error: function (data) {}
    });
}
$(function () {
    $("#program").change(function (event) {
        var data = $(this).val();
        var myArr = data.split('|');
        setTimeout(function () {
            $("#program_id").val(myArr[0]);
            $("#kode_rekening").val(myArr[1] + ".");
        }, 500);
        $("#kode_rekening").focus();
    });
});
