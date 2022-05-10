import 'dart:convert';
import 'dart:io';
import 'package:dio/dio.dart';

class ApiProvider {
  static final BASE_URL = "https://laphar.esdm.go.id/api";
  // static final BASE_URL = "http://172.16.23.34/laporan-harian-esdm/api";
  // static final BASE_URL = "http://192.168.1.3/laporan-harian-esdm/api";

  static Dio init() {
    String username = 'admin2';
    String password = '1234';
    String basicAuth = 'Basic ' + base64Encode(utf8.encode('$username:$password'));
    Dio dio = new Dio(new BaseOptions(
      baseUrl: BASE_URL,
      connectTimeout: 10000,
      receiveTimeout: 10000,
      headers: {
        "Content-Type": "application/json",
        'authorization': basicAuth
        },
      // contentType: ContentType.JSON,
      // Transform the response data to a String encoded with UTF8.
      // The default value is [ResponseType.JSON].
      // responseType: ResponseType.PLAIN
    ));
    dio.interceptors.add(
      InterceptorsWrapper(
        onRequest:(RequestOptions options){
        // Do something before request is sent
        return options; //continue
        // If you want to resolve the request with some custom data，
        // you can return a `Response` object or return `dio.resolve(data)`.
        // If you want to reject the request with a error message, 
        // you can return a `DioError` object or return `dio.reject(errMsg)`    
        },
        onResponse:(Response response) {
        // Do something with response data
        return response; // continue
        },
        onError: (DioError e) {
        // Do something with response error
        // e.message = "Test";
        if (e.type == DioErrorType.DEFAULT) {
          // e.message = "Failed to connect server, make sure your internet connection is stable";
        }
        print("DIO ERROR");
        print(e);
        return  e;//continue
        }
      )
    );

    return dio;
  }
}
