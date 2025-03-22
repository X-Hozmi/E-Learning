$("#kota").change(function () {
  let id = $(this).val();
  // console.log(id);
  $.ajax({
    url: base_url + "siakad/subprov",
    type: "POST",
    dataType: "json",
    data: { id: id },
    success: function (data) {
      // console.log(data);
      var html = "";
      var i;
      for (i = 0; i < data.length; i++) {
        html += "<option>" + data[i].PROPTBPRO + "</option>";
      }
      $("#provinsi").html(html);
    },
  });
  return false;
});
let no = $("#tbPindahStatusUjian").children().length;
for (let i = 1; i <= no; i++) {
  $(document).on("click", ".btn-simpan" + i, function () {
    let kls = $(".kls" + i).val();
    let kdmk = $(this).data("kdmk");
    let npm = $("input[name]").val();
    let smt = $("select[name]").val();
    // console.log(kdmk);
    $.ajax({
      url: base_url + "siakad/update_kelas_pindah_status_ujian",
      type: "POST",
      dataType: "json",
      data: { kls: kls, npm: npm, smt: smt, kdmk: kdmk },
      success: function (data) {
        if (data.status == "berhasil") {
          window.history.go();
        }
      },
    });
  });
}