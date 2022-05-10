// To parse this JSON data, do
//
//     final lapPusdatinHargaBbAcuan = lapPusdatinHargaBbAcuanFromJson(jsonString);

import 'dart:convert';

LapPusdatinHargaBbAcuan lapPusdatinHargaBbAcuanFromJson(String str) => LapPusdatinHargaBbAcuan.fromJson(json.decode(str));

String lapPusdatinHargaBbAcuanToJson(LapPusdatinHargaBbAcuan data) => json.encode(data.toJson());

class LapPusdatinHargaBbAcuan {
    String idLaporan;
    String tanggalLaporan;
    String harga;
    String sumber;
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

    LapPusdatinHargaBbAcuan({
        this.idLaporan,
        this.tanggalLaporan,
        this.harga,
        this.sumber,
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

    factory LapPusdatinHargaBbAcuan.fromJson(Map<String, dynamic> json) => new LapPusdatinHargaBbAcuan(
        idLaporan: json["ID_LAPORAN"] ?? "",
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        harga: json["HARGA"] ?? "",
        sumber: json["SUMBER"] ?? "",
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
        "HARGA": harga ?? "",
        "SUMBER": sumber ?? "",
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
