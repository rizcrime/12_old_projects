package idn.eb2.emergencybutton2.Global

import idn.eb2.emergencybutton2.BuildConfig

object UtilsApi {
    fun getAPIService(): BaseApiService? {
        return RetrofitClient.getClient(BuildConfig.BASE_URL)?.create(BaseApiService::class.java)
    }
}