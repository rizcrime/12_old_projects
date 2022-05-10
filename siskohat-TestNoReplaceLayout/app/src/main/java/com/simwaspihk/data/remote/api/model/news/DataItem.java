package com.simwaspihk.data.remote.api.model.news;

import javax.annotation.Generated;
import com.google.gson.annotations.SerializedName;

@Generated("com.robohorse.robopojogenerator")
public class DataItem{

	@SerializedName("news_detail")
	private String newsDetail;

	@SerializedName("news_image")
	private String newsImage;

	@SerializedName("code")
	private String code;

	@SerializedName("news_header")
	private String newsHeader;

	@SerializedName("id")
	private String id;

	@SerializedName("news_title")
	private String newsTitle;

	public void setNewsDetail(String newsDetail){
		this.newsDetail = newsDetail;
	}

	public String getNewsDetail(){
		return newsDetail;
	}

	public void setNewsImage(String newsImage){
		this.newsImage = newsImage;
	}

	public String getNewsImage(){
		return newsImage;
	}

	public void setCode(String code){
		this.code = code;
	}

	public String getCode(){
		return code;
	}

	public void setNewsHeader(String newsHeader){
		this.newsHeader = newsHeader;
	}

	public String getNewsHeader(){
		return newsHeader;
	}

	public void setId(String id){
		this.id = id;
	}

	public String getId(){
		return id;
	}

	public void setNewsTitle(String newsTitle){
		this.newsTitle = newsTitle;
	}

	public String getNewsTitle(){
		return newsTitle;
	}

	@Override
 	public String toString(){
		return 
			"DataTbsaran{" +
			"news_detail = '" + newsDetail + '\'' + 
			",news_image = '" + newsImage + '\'' + 
			",code = '" + code + '\'' + 
			",news_header = '" + newsHeader + '\'' + 
			",id = '" + id + '\'' + 
			",news_title = '" + newsTitle + '\'' + 
			"}";
		}
}