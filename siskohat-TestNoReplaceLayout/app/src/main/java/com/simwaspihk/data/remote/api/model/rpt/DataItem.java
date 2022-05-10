package com.simwaspihk.data.remote.api.model.rpt;

import com.google.gson.annotations.SerializedName;

import javax.annotation.Generated;

@Generated("com.robohorse.robopojogenerator")
public class DataItem{

	@SerializedName("plan_tanggal")
	private String planTanggal;

	@SerializedName("no_flight")
	private String noFlight;

	@SerializedName("lain")
	private Object lain;

	@SerializedName("wanita")
	private Object wanita;

	@SerializedName("plan_jumlah")
	private String planJumlah;

	@SerializedName("sakit")
	private Object sakit;

	@SerializedName("pria")
	private Object pria;

	@SerializedName("no_urut")
	private String noUrut;

	@SerializedName("jumlah")
	private String jumlah;

	@SerializedName("user_id")
	private String userId;

	@SerializedName("wafat")
	private Object wafat;

	@SerializedName("bandara_transit")
	private String bandaraTransit;

	@SerializedName("name")
	private String name;

	@SerializedName("plan_pukul")
	private String planPukul;

	@SerializedName("id")
	private String id;

	@SerializedName("tanggal")
	private String tanggal;

	@SerializedName("pukul")
	private String pukul;

	@SerializedName("plan_flight")
	private String planFlight;

	@SerializedName("bandara")
	private String bandara;

	@SerializedName("status")
	private Object status;

	public void setPlanTanggal(String planTanggal){
		this.planTanggal = planTanggal;
	}

	public String getPlanTanggal(){
		return planTanggal;
	}

	public void setNoFlight(String noFlight){
		this.noFlight = noFlight;
	}

	public String getNoFlight(){
		return noFlight;
	}

	public void setLain(Object lain){
		this.lain = lain;
	}

	public Object getLain(){
		return lain;
	}

	public void setWanita(Object wanita){
		this.wanita = wanita;
	}

	public Object getWanita(){
		return wanita;
	}

	public void setPlanJumlah(String planJumlah){
		this.planJumlah = planJumlah;
	}

	public String getPlanJumlah(){
		return planJumlah;
	}

	public void setSakit(Object sakit){
		this.sakit = sakit;
	}

	public Object getSakit(){
		return sakit;
	}

	public void setPria(Object pria){
		this.pria = pria;
	}

	public Object getPria(){
		return pria;
	}

	public void setNoUrut(String noUrut){
		this.noUrut = noUrut;
	}

	public String getNoUrut(){
		return noUrut;
	}

	public void setJumlah(String jumlah){
		this.jumlah = jumlah;
	}

	public String getJumlah(){
		return jumlah;
	}

	public void setUserId(String userId){
		this.userId = userId;
	}

	public String getUserId(){
		return userId;
	}

	public void setWafat(Object wafat){
		this.wafat = wafat;
	}

	public Object getWafat(){
		return wafat;
	}

	public void setBandaraTransit(String bandaraTransit){
		this.bandaraTransit = bandaraTransit;
	}

	public String getBandaraTransit(){
		return bandaraTransit;
	}

	public void setName(String name){
		this.name = name;
	}

	public String getName(){
		return name;
	}

	public void setPlanPukul(String planPukul){
		this.planPukul = planPukul;
	}

	public String getPlanPukul(){
		return planPukul;
	}

	public void setId(String id){
		this.id = id;
	}

	public String getId(){
		return id;
	}

	public void setTanggal(String tanggal){
		this.tanggal = tanggal;
	}

	public String getTanggal(){
		return tanggal;
	}

	public void setPukul(String pukul){
		this.pukul = pukul;
	}

	public String getPukul(){
		return pukul;
	}

	public void setPlanFlight(String planFlight){
		this.planFlight = planFlight;
	}

	public String getPlanFlight(){
		return planFlight;
	}

	public void setBandara(String bandara){
		this.bandara = bandara;
	}

	public String getBandara(){
		return bandara;
	}

	public void setStatus(Object status){
		this.status = status;
	}

	public Object getStatus(){
		return status;
	}

	@Override
 	public String toString(){
		return 
			"DataTbsaran{" +
			"plan_tanggal = '" + planTanggal + '\'' + 
			",no_flight = '" + noFlight + '\'' + 
			",lain = '" + lain + '\'' + 
			",wanita = '" + wanita + '\'' + 
			",plan_jumlah = '" + planJumlah + '\'' + 
			",sakit = '" + sakit + '\'' + 
			",pria = '" + pria + '\'' + 
			",no_urut = '" + noUrut + '\'' + 
			",jumlah = '" + jumlah + '\'' + 
			",user_id = '" + userId + '\'' + 
			",wafat = '" + wafat + '\'' + 
			",bandara_transit = '" + bandaraTransit + '\'' + 
			",name = '" + name + '\'' + 
			",plan_pukul = '" + planPukul + '\'' + 
			",id = '" + id + '\'' + 
			",tanggal = '" + tanggal + '\'' + 
			",pukul = '" + pukul + '\'' + 
			",plan_flight = '" + planFlight + '\'' + 
			",bandara = '" + bandara + '\'' + 
			",status = '" + status + '\'' + 
			"}";
		}
}