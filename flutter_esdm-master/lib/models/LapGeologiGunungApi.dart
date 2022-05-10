// To parse this JSON data, do
//
//     final lapGeologiGunungApi = lapGeologiGunungApiFromJson(jsonString);

import 'dart:convert';

LapGeologiGunungApi lapGeologiGunungApiFromJson(String str) => LapGeologiGunungApi.fromJson(json.decode(str));

String lapGeologiGunungApiToJson(LapGeologiGunungApi data) => json.encode(data.toJson());

class LapGeologiGunungApi {
    String idLaporan;
    String idGunung;
    String namaGunung;
    String level;
    String idAktivitas;
    String tanggalLaporan;
    String keterangan;
    String detail;
    String rekomendasi;
    String vona;
    dynamic isPost;
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

    LapGeologiGunungApi({
        this.idLaporan,
        this.idGunung,
        this.namaGunung,
        this.level,
        this.idAktivitas,
        this.tanggalLaporan,
        this.keterangan,
        this.detail,
        this.rekomendasi,
        this.vona,
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

    factory LapGeologiGunungApi.fromJson(Map<String, dynamic> json) => new LapGeologiGunungApi(
        idLaporan: json["ID_LAPORAN"] ?? "",
        idGunung: json["ID_GUNUNG"] ?? "",
        namaGunung: json["NAMA_GUNUNG"] ?? "",
        level: json["LEVEL"] ?? "",
        idAktivitas: json["ID_AKTIVITAS"] ?? "",
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        keterangan: json["KETERANGAN"] ?? "",
        detail: json["DETAIL"] ?? "",
        rekomendasi: json["REKOMENDASI"] ?? "",
        vona: json["VONA"] ?? "",
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
        "ID_GUNUNG": idGunung ?? "",
        "NAMA_GUNUNG": namaGunung ?? "",
        "LEVEL": level ?? "",
        "ID_AKTIVITAS": idAktivitas ?? "",
        "TANGGAL_LAPORAN": tanggalLaporan ?? "",
        "KETERANGAN": keterangan ?? "",
        "DETAIL": detail ?? "",
        "REKOMENDASI": rekomendasi ?? "",
        "VONA": vona ?? "",
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
