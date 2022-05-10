// To parse this JSON data, do
//
//     final lapBeritaNegatif = lapBeritaNegatifFromJson(jsonString);

import 'dart:convert';

LapBeritaNegatif lapBeritaNegatifFromJson(String str) => LapBeritaNegatif.fromJson(json.decode(str));

String lapBeritaNegatifToJson(LapBeritaNegatif data) => json.encode(data.toJson());

class LapBeritaNegatif {
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

    LapBeritaNegatif({
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

    factory LapBeritaNegatif.fromJson(Map<String, dynamic> json) => new LapBeritaNegatif(
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
