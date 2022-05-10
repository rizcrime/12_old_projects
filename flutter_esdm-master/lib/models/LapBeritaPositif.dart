// To parse this JSON data, do
//
//     final lapBeritaPositif = lapBeritaPositifFromJson(jsonString);

import 'dart:convert';

LapBeritaPositif lapBeritaPositifFromJson(String str) => LapBeritaPositif.fromJson(json.decode(str));

String lapBeritaPositifToJson(LapBeritaPositif data) => json.encode(data.toJson());

class LapBeritaPositif {
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

    LapBeritaPositif({
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

    factory LapBeritaPositif.fromJson(Map<String, dynamic> json) => new LapBeritaPositif(
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
