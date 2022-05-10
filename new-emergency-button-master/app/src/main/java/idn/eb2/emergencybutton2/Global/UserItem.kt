package idn.eb2.emergencybutton2.Global

import com.google.gson.annotations.SerializedName
import okhttp3.MultipartBody

data class UserItem(

    @field:SerializedName("msg")
    var msg: String? = null,

    @field:SerializedName("data")
    var data: Data? = null,

    @field:SerializedName("status")
    var status: String? = null
)

data class Data(

    @field:SerializedName("number")
    var number: String? = "",

    @field:SerializedName("image")
    var image: String? = "",

    @field:SerializedName("pass")
    var pass: String? = "",

    @field:SerializedName("name")
    var name: String? = "",

    @field:SerializedName("id")
    var id: Int? = 0,

    @field:SerializedName("email")
    var email: String? = ""
)
