package com.simwaspihk.data.remote.api.model.travel;

import com.google.gson.annotations.SerializedName;
import java.util.List;

public class TravelResponse {
    @SerializedName("data")
    private List<TravelData> data;
    @SerializedName("Status")
    private String status;

    public void setStatus(String status) {
        this.status = status;
    }

    public String getStatus() {
        return this.status;
    }

    public void setData(List<TravelData> data) {
        this.data = data;
    }

    public List<TravelData> getData() {
        return this.data;
    }

    public String toString() {
        return "TravelResponse{status = '" + this.status + '\'' + ",data = '" + this.data + '\'' + "}";
    }
}
