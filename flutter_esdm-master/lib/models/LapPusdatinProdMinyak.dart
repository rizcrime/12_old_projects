// To parse this JSON data, do
//
//     final lapPusdatinProdMinyak = lapPusdatinProdMinyakFromJson(jsonString);

import 'dart:convert';

LapPusdatinProdMinyak lapPusdatinProdMinyakFromJson(String str) => LapPusdatinProdMinyak.fromJson(json.decode(str));

String lapPusdatinProdMinyakToJson(LapPusdatinProdMinyak data) => json.encode(data.toJson());

class LapPusdatinProdMinyak {
    String idLaporan;
    String tanggalLaporan;
    String prodHarian;
    String prodBulanan;
    String prodTahunan;
    String apbn;
    dynamic isPost;
    String userEntry;
    String tanggalEntry;
    String flatformEntry;
    dynamic userPost;
    dynamic tanggalPost;
    dynamic flatformPost;
    String catatanReview;
    dynamic hasReview;
    dynamic userReview;
    dynamic tanggalReview;
    dynamic flatformReview;

    LapPusdatinProdMinyak({
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
        this.userReview,
        this.tanggalReview,
        this.flatformReview,
    });

    factory LapPusdatinProdMinyak.fromJson(Map<String, dynamic> json) => new LapPusdatinProdMinyak(
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
        userReview: json["USER_REVIEW"] ?? "",
        tanggalReview: json["TANGGAL_REVIEW"] ?? "",
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
        "USER_REVIEW": userReview ?? "",
        "TANGGAL_REVIEW": tanggalReview ?? "",
        "FLATFORM_REVIEW": flatformReview ?? "",
    };
}
