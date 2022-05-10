package idn.eb2.emergencybutton2.MVP.View

import android.Manifest
import android.annotation.SuppressLint
import android.app.Activity
import android.content.Context
import android.content.Intent
import android.content.SharedPreferences
import android.graphics.Bitmap
import android.graphics.ImageDecoder
import android.net.Uri
import android.os.Build
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import android.widget.Toast
import androidx.annotation.RequiresApi
import com.theartofdev.edmodo.cropper.CropImage
import idn.eb2.emergencybutton2.MVP.Model.RegisterModel
import idn.eb2.emergencybutton2.MVP.Presenter.RegisterPresenter
import idn.eb2.emergencybutton2.R
import kotlinx.android.synthetic.main.register_layout_activity.*
import okhttp3.MediaType
import okhttp3.MultipartBody
import okhttp3.RequestBody
import pub.devrel.easypermissions.AfterPermissionGranted
import pub.devrel.easypermissions.EasyPermissions
import java.io.File
import java.io.FileOutputStream
import java.io.IOException
import java.io.OutputStream

class RegisterActivity : AppCompatActivity(), RegisterModel.View {

    private lateinit var myPref: SharedPreferences
    private lateinit var editor: SharedPreferences.Editor
    private val presenter: RegisterPresenter = RegisterPresenter(this)
    private val requestCheckCamera = 1
    private val requestTakePhoto = 1
    private val requestChoosePhoto = 2
    private var file: File? = null

    @SuppressLint("CommitPrefEdits")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.register_layout_activity)

        goneLoading()

        myPref = this.getSharedPreferences("userInfo", Context.MODE_PRIVATE)
        editor = this.getSharedPreferences("userInfo", Context.MODE_PRIVATE).edit()

        foto_profile.setOnClickListener {
            checkCameraPermission()
            cropImageAutoSelection()
        }

        btn_daftar.setOnClickListener {
            @Suppress("SENSELESS_COMPARISON")
            if(file == null){
                Toast.makeText(this, "Mohon masukan dulu foto anda", Toast.LENGTH_SHORT).show()
            }else{
                showLoading()
                val requestFile : RequestBody = RequestBody.create(MediaType.parse("multipart/form-data"), file!!)
                val body : MultipartBody.Part = MultipartBody.Part.createFormData("image", file!!.path, requestFile)
                val nama : RequestBody = RequestBody.create(MediaType.parse("multipart/form-data"), edt_nama_lengkap.text.toString())
                val nomor : RequestBody = RequestBody.create(MediaType.parse("multipart/form-data"), edt_nomor_hp.text.toString())
                val email : RequestBody = RequestBody.create(MediaType.parse("multipart/form-data"), edt_email.text.toString())
                val password : RequestBody = RequestBody.create(MediaType.parse("multipart/form-data"), edt_password.text.toString())
                presenter.pushRegisterData(nama,nomor,email,password,body)
            }
        }

        btn_to_login.setOnClickListener {
            showLoading()
            this.finish()
            goToLogin()
        }

    }

    @AfterPermissionGranted(1)
    private fun checkCameraPermission() {
        val perm: String = Manifest.permission.CAMERA
        if (this.let { EasyPermissions.hasPermissions(it, perm) }){
            TODO()
        }
        else {
            EasyPermissions.requestPermissions(this, "Butuh permission camera", requestCheckCamera, perm)
        }
    }

    private fun cropImageAutoSelection() {
        this.let {
            CropImage.activity()
                .setAspectRatio(2, 2)
                .start(this)
        }
    }

    @RequiresApi(Build.VERSION_CODES.P)
    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)

        if (requestCode == requestTakePhoto && resultCode == Activity.RESULT_OK) {
            val extras: Bundle? = data?.extras
            val bitmap: Bitmap = extras?.get("data") as Bitmap

            val filesDir: File = this.filesDir
            val imageFile = File(filesDir, "image" + ".jpg")

            val os: OutputStream
            try {
                os = FileOutputStream(imageFile)
                bitmap.compress(Bitmap.CompressFormat.JPEG, 100, os)
                os.flush()
                os.close()
                file = imageFile
                foto_profile.setImageBitmap(bitmap)
            } catch (e: Exception) {
                Log.e(javaClass.simpleName, "Error writing bitmap", e)
            }
        } else if (requestCode == requestChoosePhoto && resultCode == Activity.RESULT_OK) {
            val uri: Uri? = data?.data

            this.let { CropImage.activity(uri).setAspectRatio(1, 1).start(it) }
        }

        if (requestCode == CropImage.CROP_IMAGE_ACTIVITY_REQUEST_CODE) {
            if (data==null){
                Toast.makeText(this, "Anda keluar sebelum memilih foto", Toast.LENGTH_LONG).show()
            }else{
                Toast.makeText(this, "Foto anda berhasil dipilih", Toast.LENGTH_LONG).show()
                val result: CropImage.ActivityResult = CropImage.getActivityResult(data)
                if (resultCode == Activity.RESULT_OK) {
                    val imageUri: Uri = result.uri
                    try {
                        val bitmap: Bitmap = ImageDecoder.decodeBitmap(
                            ImageDecoder.createSource(
                                this.contentResolver,
                                imageUri
                            )
                        )
                        val filesDir: File = this.filesDir!!
                        val imageFile = File(filesDir, "image" + ".jpg")
                        editor.putString("image", imageFile.toString())

                        val os: OutputStream = FileOutputStream(imageFile)
                        bitmap.compress(Bitmap.CompressFormat.JPEG, 100, os)
                        os.flush()
                        os.close()
                        file = imageFile
                        foto_profile.setImageBitmap(bitmap)
                    } catch (e: IOException) {
                        Log.e(javaClass.simpleName, "Error writing bitmap", e)
                        e.printStackTrace()
                    }
                }
            }
        }
    }

    override fun goneLoading() {
        progress_register.visibility = View.GONE
    }

    override fun showLoading() {
        progress_register.visibility = View.VISIBLE
    }

    override fun goToLogin() {
        val intent = Intent(this, LoginActivity::class.java)
        this.finish()
        startActivity(intent)
    }

    override fun isFailure(msg: String) {
        goneLoading()
        Toast.makeText(this, msg, Toast.LENGTH_SHORT).show()
    }

    override fun isSuccess(msg: String) {
        goneLoading()
        Toast.makeText(this, msg, Toast.LENGTH_SHORT).show()
        goToLogin()
    }

    override fun onRequestPermissionsResult(requestCode: Int, permissions: Array<out String>, grantResults: IntArray) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        EasyPermissions.onRequestPermissionsResult(requestCode, permissions, grantResults, this)
    }

}
