package com.simwaspihk.data.remote.api.model.profiles.update;

import javax.annotation.Generated;
import com.google.gson.annotations.SerializedName;

@Generated("com.robohorse.robopojogenerator")
public class ResponseUpdateProfiles{

	@SerializedName("Status")
	private String status;

	@SerializedName("msg")
	private String msg;

	public void setStatus(String status){
		this.status = status;
	}

	public String getStatus(){
		return status;
	}

	public void setMsg(String msg){
		this.msg = msg;
	}

	public String getMsg(){
		return msg;
	}

	@Override
 	public String toString(){
		return 
			"ResponseUpdateProfiles{" + 
			"status = '" + status + '\'' + 
			",msg = '" + msg + '\'' + 
			"}";
		}
}