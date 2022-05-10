// To parse this JSON data, do
//
//     final lapBeritaHotNews = lapBeritaHotNewsFromJson(jsonString);

import 'dart:convert';

LapBeritaHotNews lapBeritaHotNewsFromJson(String str) => LapBeritaHotNews.fromJson(json.decode(str));

String lapBeritaHotNewsToJson(LapBeritaHotNews data) => json.encode(data.toJson());

class LapBeritaHotNews {
    String idLaporan;
    String tanggalLaporan;
    String berita;
    dynamic jenis;
    String url;
    dynamic isPost;
    String userEntry;
    String tanggalEntry;
    String flatformEntry;
    dynamic userPost;
    dynamic tanggalPost;
    dynamic flatformPost;
    String image;

    LapBeritaHotNews({
        this.idLaporan,
        this.tanggalLaporan,
        this.berita,
        this.jenis,
        this.url,
        this.isPost,
        this.userEntry,
        this.tanggalEntry,
        this.flatformEntry,
        this.userPost,
        this.tanggalPost,
        this.flatformPost,
        this.image,
    });

    factory LapBeritaHotNews.fromJson(Map<String, dynamic> json) => new LapBeritaHotNews(
        idLaporan: json["ID_LAPORAN"] ?? "",
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        berita: json["BERITA"] ?? "",
        jenis: json["JENIS"] ?? "",
        url: json["URL"] ?? "",
        isPost: json["IS_POST"] ?? "",
        userEntry: json["USER_ENTRY"] ?? "",
        tanggalEntry: json["TANGGAL_ENTRY"] ?? "",
        flatformEntry: json["FLATFORM_ENTRY"] ?? "",
        userPost: json["USER_POST"] ?? "",
        tanggalPost: json["TANGGAL_POST"] ?? "",
        flatformPost: json["FLATFORM_POST"] ?? "",
        image: json["IMAGE"] ?? "",
    );

    Map<String, dynamic> toJson() => {
        "ID_LAPORAN": idLaporan ?? "",
        "TANGGAL_LAPORAN": tanggalLaporan ?? "",
        "BERITA": berita ?? "",
        "JENIS": jenis ?? "",
        "URL": url ?? "",
        "IS_POST": isPost ?? "",
        "USER_ENTRY": userEntry ?? "",
        "TANGGAL_ENTRY": tanggalEntry ?? "",
        "FLATFORM_ENTRY": flatformEntry ?? "",
        "USER_POST": userPost ?? "",
        "TANGGAL_POST": tanggalPost ?? "",
        "FLATFORM_POST": flatformPost ?? "",
        "IMAGE": image ?? "",
    };
}
