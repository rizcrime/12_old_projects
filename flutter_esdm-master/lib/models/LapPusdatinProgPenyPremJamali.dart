// To parse this JSON data, do
//
//     final lapPusdatinProgPenyPremJamali = lapPusdatinProgPenyPremJamaliFromJson(jsonString);

import 'dart:convert';

LapPusdatinProgPenyPremJamali lapPusdatinProgPenyPremJamaliFromJson(String str) => LapPusdatinProgPenyPremJamali.fromJson(json.decode(str));

String lapPusdatinProgPenyPremJamaliToJson(LapPusdatinProgPenyPremJamali data) => json.encode(data.toJson());

class LapPusdatinProgPenyPremJamali {
    String idLaporan;
    String tanggalLaporan;
    String progres;
    String catatan;
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

    LapPusdatinProgPenyPremJamali({
        this.idLaporan,
        this.tanggalLaporan,
        this.progres,
        this.catatan,
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

    factory LapPusdatinProgPenyPremJamali.fromJson(Map<String, dynamic> json) => new LapPusdatinProgPenyPremJamali(
        idLaporan: json["ID_LAPORAN"] ?? "",
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        progres: json["PROGRES"] ?? "",
        catatan: json["CATATAN"] ?? "",
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
        "PROGRES": progres ?? "",
        "CATATAN": catatan ?? "",
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
