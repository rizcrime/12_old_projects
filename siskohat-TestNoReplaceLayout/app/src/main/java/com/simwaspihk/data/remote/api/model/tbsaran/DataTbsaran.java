package com.simwaspihk.data.remote.api.model.tbsaran;

import com.google.gson.annotations.SerializedName;

public class DataTbsaran {
    @SerializedName("hambatan")
    private String hambatan;
    @SerializedName("id")
    private String id;
    @SerializedName("name")
    private String name;
    @SerializedName("saran")
    private String saran;
    @SerializedName("user_id")
    private String userId;

    public void setSaran(String saran) {
        this.saran = saran;
    }

    public String getSaran() {
        return this.saran;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    public String getUserId() {
        return this.userId;
    }

    public void setHambatan(String hambatan) {
        this.hambatan = hambatan;
    }

    public String getHambatan() {
        return this.hambatan;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getName() {
        return this.name;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getId() {
        return this.id;
    }

    public String toString() {
        return "DataTbsaran{saran = '" + this.saran + '\'' + ",user_id = '" + this.userId + '\'' + ",hambatan = '" + this.hambatan + '\'' + ",name = '" + this.name + '\'' + ",id = '" + this.id + '\'' + "}";
    }
}
