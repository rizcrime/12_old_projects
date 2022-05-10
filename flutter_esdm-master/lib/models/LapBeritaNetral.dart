// To parse this JSON data, do
//
//     final lapBeritaNetral = lapBeritaNetralFromJson(jsonString);

import 'dart:convert';

LapBeritaNetral lapBeritaNetralFromJson(String str) => LapBeritaNetral.fromJson(json.decode(str));

String lapBeritaNetralToJson(LapBeritaNetral data) => json.encode(data.toJson());

class LapBeritaNetral {
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

    LapBeritaNetral({
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
    });

    factory LapBeritaNetral.fromJson(Map<String, dynamic> json) => new LapBeritaNetral(
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
    };
}
