package com.simwaspihk.data.remote.api.model.tbsakit;

import com.google.gson.annotations.SerializedName;
import java.util.List;

public class TbsakitResponse {
    @SerializedName("data")
    private List<DataTbsakit> data;
    @SerializedName("Error")
    private String error;
    @SerializedName("Msg")
    private String msg;
    @SerializedName("Status")
    private String status;

    public void setStatus(String status) {
        this.status = status;
    }

    public String getStatus() {
        return this.status;
    }

    public void setMsg(String msg) {
        this.msg = msg;
    }

    public String getMsg() {
        return this.msg;
    }

    public void setData(List<DataTbsakit> data) {
        this.data = data;
    }

    public List<DataTbsakit> getData() {
        return this.data;
    }

    public void setError(String error) {
        this.error = error;
    }

    public String getError() {
        return this.error;
    }

    public String toString() {
        return "ResponseTbsakit{status = '" + this.status + '\'' + ",msg = '" + this.msg + '\'' + ",data = '" + this.data + '\'' + ",error = '" + this.error + '\'' + "}";
    }
}
