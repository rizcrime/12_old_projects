package com.simwaspihk.data.remote.api.model.rpt.delete;

import javax.annotation.Generated;
import com.google.gson.annotations.SerializedName;

@Generated("com.robohorse.robopojogenerator")
public class ResponseDeleteRpt{

	@SerializedName("Status")
	private String status;

	public void setStatus(String status){
		this.status = status;
	}

	public String getStatus(){
		return status;
	}

	@Override
 	public String toString(){
		return 
			"ResponseDeleteRpt{" + 
			"status = '" + status + '\'' + 
			"}";
		}
}