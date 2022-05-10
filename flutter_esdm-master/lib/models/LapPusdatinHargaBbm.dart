// To parse this JSON data, do
//
//     final lapPusdatinHargaBbm = lapPusdatinHargaBbmFromJson(jsonString);

import 'dart:convert';

LapPusdatinHargaBbm lapPusdatinHargaBbmFromJson(String str) => LapPusdatinHargaBbm.fromJson(json.decode(str));

String lapPusdatinHargaBbmToJson(LapPusdatinHargaBbm data) => json.encode(data.toJson());

class LapPusdatinHargaBbm {
    String idLaporan;
    String tanggalLaporan;
    String jenisTertentu;
    String bbmUmum;
    String progIndSatuHrg;
    String hargaPernegara;
    String isPost;
    String userEntry;
    String tanggalEntry;
    String flatformEntry;
    dynamic userPost;
    dynamic tanggalPost;
    dynamic flatformPost;
    dynamic catatanReview;
    dynamic hasReview;
    dynamic tanggalReview;
    dynamic userReview;
    dynamic flatformReview;

    LapPusdatinHargaBbm({
        this.idLaporan,
        this.tanggalLaporan,
        this.jenisTertentu,
        this.bbmUmum,
        this.progIndSatuHrg,
        this.hargaPernegara,
        this.isPost,
        this.userEntry,
        this.tanggalEntry,
        this.flatformEntry,
        this.userPost,
        this.tanggalPost,
        this.flatformPost,
        this.catatanReview,
        this.hasReview,
        this.tanggalReview,
        this.userReview,
        this.flatformReview,
    });

    factory LapPusdatinHargaBbm.fromJson(Map<String, dynamic> json) => new LapPusdatinHargaBbm(
        idLaporan: json["ID_LAPORAN"] ?? "",
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        jenisTertentu: json["JENIS_TERTENTU"] ?? "",
        bbmUmum: json["BBM_UMUM"] ?? "",
        progIndSatuHrg: json["PROG_IND_SATU_HRG"] ?? "",
        hargaPernegara: json["HARGA_PERNEGARA"] ?? "",
        isPost: json["IS_POST"] ?? "",
        userEntry: json["USER_ENTRY"] ?? "",
        tanggalEntry: json["TANGGAL_ENTRY"] ?? "",
        flatformEntry: json["FLATFORM_ENTRY"] ?? "",
        userPost: json["USER_POST"] ?? "",
        tanggalPost: json["TANGGAL_POST"] ?? "",
        flatformPost: json["FLATFORM_POST"] ?? "",
        catatanReview: json["CATATAN_REVIEW"] ?? "",
        hasReview: json["HAS_REVIEW"] ?? "",
        tanggalReview: json["TANGGAL_REVIEW"] ?? "",
        userReview: json["USER_REVIEW"] ?? "",
        flatformReview: json["FLATFORM_REVIEW"] ?? "",
    );

    Map<String, dynamic> toJson() => {
        "ID_LAPORAN": idLaporan ?? "",
        "TANGGAL_LAPORAN": tanggalLaporan ?? "",
        "JENIS_TERTENTU": jenisTertentu ?? "",
        "BBM_UMUM": bbmUmum ?? "",
        "PROG_IND_SATU_HRG": progIndSatuHrg ?? "",
        "HARGA_PERNEGARA": hargaPernegara ?? "",
        "IS_POST": isPost ?? "",
        "USER_ENTRY": userEntry ?? "",
        "TANGGAL_ENTRY": tanggalEntry ?? "",
        "FLATFORM_ENTRY": flatformEntry ?? "",
        "USER_POST": userPost ?? "",
        "TANGGAL_POST": tanggalPost ?? "",
        "FLATFORM_POST": flatformPost ?? "",
        "CATATAN_REVIEW": catatanReview ?? "",
        "HAS_REVIEW": hasReview ?? "",
        "TANGGAL_REVIEW": tanggalReview ?? "",
        "USER_REVIEW": userReview ?? "",
        "FLATFORM_REVIEW": flatformReview ?? "",
    };
}
