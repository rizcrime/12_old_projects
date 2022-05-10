package com.simwaspihk.data.remote.api.model.rpt;

import com.google.gson.annotations.SerializedName;

import java.util.List;

import javax.annotation.Generated;

@Generated("com.robohorse.robopojogenerator")
public class ResponseRpt{

	@SerializedName("Status")
	private String status;

	@SerializedName("Data")
	private List<DataItem> data;

	public void setStatus(String status){
		this.status = status;
	}

	public String getStatus(){
		return status;
	}

	public void setData(List<DataItem> data){
		this.data = data;
	}

	public List<DataItem> getData(){
		return data;
	}

	@Override
 	public String toString(){
		return 
			"ResponseRpt{" + 
			"status = '" + status + '\'' + 
			",data = '" + data + '\'' + 
			"}";
		}
}