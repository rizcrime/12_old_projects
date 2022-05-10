// To parse this JSON data, do
//
//     final lapPusdatinBeritaOpecHarian = lapPusdatinBeritaOpecHarianFromJson(jsonString);

import 'dart:convert';

LapPusdatinBeritaOpecHarian lapPusdatinBeritaOpecHarianFromJson(String str) => LapPusdatinBeritaOpecHarian.fromJson(json.decode(str));

String lapPusdatinBeritaOpecHarianToJson(LapPusdatinBeritaOpecHarian data) => json.encode(data.toJson());

class LapPusdatinBeritaOpecHarian {
    String idLaporan;
    String tanggalLaporan;
    String berita;
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

    LapPusdatinBeritaOpecHarian({
        this.idLaporan,
        this.tanggalLaporan,
        this.berita,
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

    factory LapPusdatinBeritaOpecHarian.fromJson(Map<String, dynamic> json) => new LapPusdatinBeritaOpecHarian(
        idLaporan: json["ID_LAPORAN"] ?? "",
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        berita: json["BERITA"] ?? "",
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
        "BERITA": berita ?? "",
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
