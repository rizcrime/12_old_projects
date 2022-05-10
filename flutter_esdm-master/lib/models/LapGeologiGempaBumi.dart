// To parse this JSON data, do
//
//     final lapGeologiGempaBumi = lapGeologiGempaBumiFromJson(jsonString);

import 'dart:convert';

LapGeologiGempaBumi lapGeologiGempaBumiFromJson(String str) => LapGeologiGempaBumi.fromJson(json.decode(str));

String lapGeologiGempaBumiToJson(LapGeologiGempaBumi data) => json.encode(data.toJson());

class LapGeologiGempaBumi {
    String idLaporan;
    String tanggalLaporan;
    String lokasi;
    String informasi;
    String kondisiGeologiDt;
    String penyebabGempa;
    dynamic dampakGempa;
    String rekomendasi;
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

    LapGeologiGempaBumi({
        this.idLaporan,
        this.tanggalLaporan,
        this.lokasi,
        this.informasi,
        this.kondisiGeologiDt,
        this.penyebabGempa,
        this.dampakGempa,
        this.rekomendasi,
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

    factory LapGeologiGempaBumi.fromJson(Map<String, dynamic> json) => new LapGeologiGempaBumi(
        idLaporan: json["ID_LAPORAN"] ?? "", 
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        lokasi: json["LOKASI"] ?? "",
        informasi: json["INFORMASI"] ?? "",
        kondisiGeologiDt: json["KONDISI_GEOLOGI_DT"] ?? "",
        penyebabGempa: json["PENYEBAB_GEMPA"] ?? "",
        dampakGempa: json["DAMPAK_GEMPA"] ?? "",
        rekomendasi: json["REKOMENDASI"] ?? "",
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
        "LOKASI": lokasi ?? "",
        "INFORMASI": informasi ?? "",
        "KONDISI_GEOLOGI_DT": kondisiGeologiDt ?? "",
        "PENYEBAB_GEMPA": penyebabGempa ?? "",
        "DAMPAK_GEMPA": dampakGempa ?? "",
        "REKOMENDASI": rekomendasi ?? "",
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
