//

import 'dart:convert';

LapPusdatinIcp lapPusdatinIcpFromJson(String str) => LapPusdatinIcp.fromJson(json.decode(str));

String lapPusdatinIcpToJson(LapPusdatinIcp data) => json.encode(data.toJson());

class LapPusdatinIcp {
    String idLaporan;
    String tanggalLaporan;
    String keterangan;
    dynamic prod01;
    dynamic prod02;
    dynamic prod03;
    dynamic prod04;
    dynamic prod05;
    dynamic prod06;
    dynamic prod07;
    dynamic prod08;
    dynamic prod09;
    dynamic prod10;
    dynamic prod11;
    dynamic prod12;
    dynamic prodTahunan;
    dynamic apbn;
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

    LapPusdatinIcp({
        this.idLaporan,
        this.tanggalLaporan,
        this.keterangan,
        this.prod01,
        this.prod02,
        this.prod03,
        this.prod04,
        this.prod05,
        this.prod06,
        this.prod07,
        this.prod08,
        this.prod09,
        this.prod10,
        this.prod11,
        this.prod12,
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
        this.tanggalReview,
        this.userReview,
        this.flatformReview,
    });

    factory LapPusdatinIcp.fromJson(Map<String, dynamic> json) => new LapPusdatinIcp(
        idLaporan: json["ID_LAPORAN"] ?? "",
        tanggalLaporan: json["TANGGAL_LAPORAN"] ?? "",
        keterangan: json["KETERANGAN"] ?? "",
        prod01: json["PROD_01"] ?? "",
        prod02: json["PROD_02"] ?? "",
        prod03: json["PROD_03"] ?? "",
        prod04: json["PROD_04"] ?? "",
        prod05: json["PROD_05"] ?? "",
        prod06: json["PROD_06"] ?? "",
        prod07: json["PROD_07"] ?? "",
        prod08: json["PROD_08"] ?? "",
        prod09: json["PROD_09"] ?? "",
        prod10: json["PROD_10"] ?? "",
        prod11: json["PROD_11"] ?? "",
        prod12: json["PROD_12"] ?? "",
        prodTahunan: json["PROD_TAHUNAN"] ?? "",
        apbn: json["APBN"] ?? "",
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
        "KETERANGAN": keterangan ?? "",
        "PROD_01": prod01 ?? "",
        "PROD_02": prod02 ?? "",
        "PROD_03": prod03 ?? "",
        "PROD_04": prod04 ?? "",
        "PROD_05": prod05 ?? "",
        "PROD_06": prod06 ?? "",
        "PROD_07": prod07 ?? "",
        "PROD_08": prod08 ?? "",
        "PROD_09": prod09 ?? "",
        "PROD_10": prod10 ?? "",
        "PROD_11": prod11 ?? "",
        "PROD_12": prod12 ?? "",
        "PROD_TAHUNAN": prodTahunan ?? "",
        "APBN": apbn ?? "",
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
