package com.simwaspihk.data.remote.api.model.auth;

import javax.annotation.Generated;
import com.google.gson.annotations.SerializedName;

@Generated("com.robohorse.robopojogenerator")
public class Data{

	@SerializedName("kode_pihk")
	private String kodePihk;

	@SerializedName("user_type")
	private String userType;

	@SerializedName("user_id")
	private String userId;

	@SerializedName("name")
	private String name;

	@SerializedName("profile_pic")
	private String profilePic;

	@SerializedName("email")
	private String email;

	public void setKodePihk(String kodePihk){
		this.kodePihk = kodePihk;
	}

	public String getKodePihk(){
		return kodePihk;
	}

	public void setUserType(String userType){
		this.userType = userType;
	}

	public String getUserType(){
		return userType;
	}

	public void setUserId(String userId){
		this.userId = userId;
	}

	public String getUserId(){
		return userId;
	}

	public void setName(String name){
		this.name = name;
	}

	public String getName(){
		return name;
	}

	public void setProfilePic(String profilePic){
		this.profilePic = profilePic;
	}

	public String getProfilePic(){
		return profilePic;
	}

	public void setEmail(String email){
		this.email = email;
	}

	public String getEmail(){
		return email;
	}

	@Override
 	public String toString(){
		return 
			"Data{" + 
			"kode_pihk = '" + kodePihk + '\'' + 
			",user_type = '" + userType + '\'' + 
			",user_id = '" + userId + '\'' + 
			",name = '" + name + '\'' + 
			",profile_pic = '" + profilePic + '\'' + 
			",email = '" + email + '\'' + 
			"}";
		}
}