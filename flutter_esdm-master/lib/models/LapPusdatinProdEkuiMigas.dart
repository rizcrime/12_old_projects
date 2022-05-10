// To parse this JSON data, do
//
//     final lapPusdatinProdEkuiMigas = lapPusdatinProdEkuiMigasFromJson(jsonString);

import 'dart:convert';

LapPusdatinProdEkuiMigas lapPusdatinProdEkuiMigasFromJson(String str) => LapPusdatinProdEkuiMigas.fromJson(json.decode(str));

String lapPusdatinProdEkuiMigasToJson(LapPusdatinProdEkuiMigas data) => json.encode(data.toJson());

class LapPusdatinProdEkuiMigas {
    String idLaporan;
    String tanggalLaporan;
    String prodHarian;
    String prodBulanan;
    String prodTahunan;
    String apbn;
    String isPost;
    String userEntry;
    String tanggalEntry;
    String flatformEntry;
    String userPost;
    String tanggalPost;
    String flatformPost;
    dynamic catatanReview;
    dynamic hasReview;
    dynamic tanggalReview;
    dynamic userReview;
    dynamic flatformReview;

    LapPusdatinProdEkuiMigas({
        this.idLaporan,
        this.tanggalLaporan,
        this.prodHarian,
        this.prodBulanan,
        this.prodTahunan,
        this.apbn,
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

    factory LapPusdatinProdEkuiMigas.fromJson(Map<String, dynamic> json) => new LapPusdatinProdEkuiMigas(
        idLaporan: json["ID_LAPORAN"] ?? "",
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        prodHarian: json["PROD_HARIAN"] ?? "0",
        prodBulanan: json["PROD_BULANAN"] ?? "0",
        prodTahunan: json["PROD_TAHUNAN"] ?? "0",
        apbn: json["APBN"] ?? "0",
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
        "PROD_HARIAN": prodHarian ?? "0",
        "PROD_BULANAN": prodBulanan ?? "0",
        "PROD_TAHUNAN": prodTahunan ?? "0",
        "APBN": apbn ?? "0",
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
