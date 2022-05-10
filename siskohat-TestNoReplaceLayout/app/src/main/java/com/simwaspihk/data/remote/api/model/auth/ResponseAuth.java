package com.simwaspihk.data.remote.api.model.auth;

import javax.annotation.Generated;
import com.google.gson.annotations.SerializedName;

@Generated("com.robohorse.robopojogenerator")
public class ResponseAuth{

	@SerializedName("Status")
	private String status;

	@SerializedName("Data")
	private Data data;

	public void setStatus(String status){
		this.status = status;
	}

	public String getStatus(){
		return status;
	}

	public void setData(Data data){
		this.data = data;
	}

	public Data getData(){
		return data;
	}

	@Override
 	public String toString(){
		return 
			"ResponseAuth{" + 
			"status = '" + status + '\'' + 
			",data = '" + data + '\'' + 
			"}";
		}
}