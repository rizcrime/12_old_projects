// To parse this JSON data, do
//
//     final lapPusdatinLiftTb = lapPusdatinLiftTbFromJson(jsonString);

import 'dart:convert';

LapPusdatinLiftTb lapPusdatinLiftTbFromJson(String str) => LapPusdatinLiftTb.fromJson(json.decode(str));

String lapPusdatinLiftTbToJson(LapPusdatinLiftTb data) => json.encode(data.toJson());

class LapPusdatinLiftTb {
    String idLaporan;
    String tanggalLaporan;
    String liftMb;
    String posisiStock;
    String salurGas;
    String isPost;
    String userEntry;
    String tanggalEntry;
    String flatformEntry;
    dynamic userPost;
    dynamic tanggalPost;
    dynamic flatformPost;
    dynamic liftGas;
    dynamic catatanReview;
    dynamic hasReview;
    dynamic tanggalReview;
    dynamic userReview;
    dynamic flatformReview;

    LapPusdatinLiftTb({
        this.idLaporan,
        this.tanggalLaporan,
        this.liftMb,
        this.posisiStock,
        this.salurGas,
        this.isPost,
        this.userEntry,
        this.tanggalEntry,
        this.flatformEntry,
        this.userPost,
        this.tanggalPost,
        this.flatformPost,
        this.liftGas,
        this.catatanReview,
        this.hasReview,
        this.tanggalReview,
        this.userReview,
        this.flatformReview,
    });

    factory LapPusdatinLiftTb.fromJson(Map<String, dynamic> json) => new LapPusdatinLiftTb(
        idLaporan: json["ID_LAPORAN"] ?? "", 
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        liftMb: json["LIFT_MB"] ?? "",
        posisiStock: json["POSISI_STOCK"] ?? "",
        salurGas: json["SALUR_GAS"] ?? "",
        isPost: json["IS_POST"] ?? "",
        userEntry: json["USER_ENTRY"] ?? "",
        tanggalEntry: json["TANGGAL_ENTRY"] ?? "",
        flatformEntry: json["FLATFORM_ENTRY"] ?? "",
        userPost: json["USER_POST"] ?? "",
        tanggalPost: json["TANGGAL_POST"] ?? "",
        flatformPost: json["FLATFORM_POST"] ?? "",
        liftGas: json["LIFT_GAS"] ?? "",
        catatanReview: json["CATATAN_REVIEW"] ?? "",
        hasReview: json["HAS_REVIEW"] ?? "",
        tanggalReview: json["TANGGAL_REVIEW"] ?? "",
        userReview: json["USER_REVIEW"] ?? "",
        flatformReview: json["FLATFORM_REVIEW"] ?? "",
    );

    Map<String, dynamic> toJson() => {
        "ID_LAPORAN": idLaporan ?? "",
        "TANGGAL_LAPORAN": tanggalLaporan ?? "",
        "LIFT_MB": liftMb ?? "",
        "POSISI_STOCK": posisiStock ?? "",
        "SALUR_GAS": salurGas ?? "",
        "IS_POST": isPost ?? "",
        "USER_ENTRY": userEntry ?? "",
        "TANGGAL_ENTRY": tanggalEntry ?? "",
        "FLATFORM_ENTRY": flatformEntry ?? "",
        "USER_POST": userPost ?? "",
        "TANGGAL_POST": tanggalPost ?? "",
        "FLATFORM_POST": flatformPost ?? "",
        "LIFT_GAS": liftGas ?? "",
        "CATATAN_REVIEW": catatanReview ?? "",
        "HAS_REVIEW": hasReview ?? "",
        "TANGGAL_REVIEW": tanggalReview ?? "",
        "USER_REVIEW": userReview ?? "",
        "FLATFORM_REVIEW": flatformReview ?? "",
    };
}
