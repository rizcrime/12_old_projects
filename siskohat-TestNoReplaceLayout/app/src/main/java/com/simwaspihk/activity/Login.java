package com.simwaspihk.activity;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Build.VERSION;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.util.Patterns;
import android.util.TypedValue;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewTreeObserver.OnGlobalLayoutListener;
import android.view.animation.Animation;
import android.view.animation.Animation.AnimationListener;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;
import com.basgeekball.awesomevalidation.AwesomeValidation;
import com.basgeekball.awesomevalidation.ValidationStyle;
import com.daimajia.androidanimations.library.BuildConfig;
import com.pixplicity.easyprefs.library.Prefs;
import com.simwaspihk.R;
import com.simwaspihk.admin.bottomNavigation.AdminNavigationActivity;
import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.model.auth.ResponseAuth;
import com.simwaspihk.other.Utils;

import java.util.ArrayList;
import java.util.List;

import dmax.dialog.SpotsDialog;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Login extends AppCompatActivity implements AnimationListener {
    private Boolean ANIMATION_ENDED = Boolean.valueOf(false);
    private Boolean START_ANIMATION = Boolean.valueOf(true);
    private View animateView;
    Button btnRegister;
    EditText etEmail;
    EditText etPassword;
    ProgressDialog loading;
    TextView mAppName;
    AwesomeValidation mAwesomeValidation;
    ApiServices mBas;
    Context mContext;
    private ImageView mFbCoverImageView;
    private ImageView mFbLogoImageView;
    private ImageView mFbLogoStaticImageView;
    TextView mForgotPswTextView;
    private Button mLoginButton;
    private ProgressBar spinner;

    /* Access modifiers changed, original: protected */
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView((int) R.layout.activity_login_default);
        overridePendingTransition(17432576, 17432577);
        this.spinner = (ProgressBar) findViewById(R.id.progressBar1);
        if (savedInstanceState != null) {
            this.START_ANIMATION = Boolean.valueOf(savedInstanceState.getBoolean("START_ANIMATION"));
        }
        this.mFbLogoImageView = (ImageView) findViewById(R.id.fbLogoImageView);
        if (getResources().getConfiguration().orientation == 1) {
            this.mFbCoverImageView = (ImageView) findViewById(R.id.fbCoverImageView);
        }
        this.mContext = this;
        this.mBas = Utils.getBAS();
        this.etEmail = (EditText) findViewById(R.id.et_email);
        this.etPassword = (EditText) findViewById(R.id.et_password);
        this.mAppName = (TextView) findViewById(R.id.appName);
        this.mForgotPswTextView = (TextView) findViewById(R.id.forgotPswTextView);
        this.mFbLogoStaticImageView = (ImageView) findViewById(R.id.fbLogoStaticImageView);
        this.mAwesomeValidation = new AwesomeValidation(ValidationStyle.BASIC);
        this.mAwesomeValidation.addValidation(this.etEmail, Patterns.EMAIL_ADDRESS, "Masukan Email");
        this.mLoginButton = (Button) findViewById(R.id.btn_login);
        this.mLoginButton.setOnClickListener(new OnClickListener() {
            public void onClick(View v) {
                Login.this.requestLogin();
            }
        });
        if (this.START_ANIMATION.booleanValue()) {
            if (getResources().getConfiguration().orientation == 1) {
                this.mFbCoverImageView.setVisibility(View.GONE);
            }
            this.etEmail.setVisibility(View.GONE);
            this.etPassword.setVisibility(View.GONE);
            this.mAppName.setVisibility(View.GONE);
            this.mForgotPswTextView.setVisibility(View.GONE);
            this.mLoginButton.setVisibility(View.GONE);
            this.mFbLogoStaticImageView.setVisibility(View.GONE);
            Animation moveFBLogoAnimation = AnimationUtils.loadAnimation(getApplicationContext(), R.anim.login_anim);
            moveFBLogoAnimation.setFillAfter(true);
            moveFBLogoAnimation.setAnimationListener(this);
            this.mFbLogoImageView.startAnimation(moveFBLogoAnimation);
        } else {
            this.mFbLogoImageView.setVisibility(View.GONE);
        }
        final View activityRootView = findViewById(R.id.mainConstraintLayout);
        activityRootView.getViewTreeObserver().addOnGlobalLayoutListener(new OnGlobalLayoutListener() {
            public void onGlobalLayout() {
                if (!Login.this.ANIMATION_ENDED.booleanValue() && Login.this.START_ANIMATION.booleanValue()) {
                    return;
                }
                if (((float) (activityRootView.getRootView().getHeight() - activityRootView.getHeight())) > Login.dpToPx(Login.this, 200.0f)) {
                    if (Login.this.getResources().getConfiguration().orientation == 1) {
                        Login.this.mFbCoverImageView.setVisibility(View.GONE);
                    }
                    Login.this.mAppName.setVisibility(View.GONE);
                    Login.this.mForgotPswTextView.setVisibility(View.GONE);
                    return;
                }
                if (Login.this.getResources().getConfiguration().orientation == 1) {
                    Login.this.mFbCoverImageView.setVisibility(View.VISIBLE);
                }
                Login.this.mAppName.setVisibility(View.VISIBLE);
                Login.this.mForgotPswTextView.setVisibility(View.VISIBLE);
            }
        });
        this.etEmail.addTextChangedListener(new TextWatcher() {
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
            }

            public void onTextChanged(CharSequence s, int start, int before, int count) {
                if (Login.this.etEmail.getText().toString().length() <= 0 || Login.this.etPassword.getText().toString().length() <= 0) {
                    Login.this.mLoginButton.setEnabled(false);
                } else {
                    Login.this.mLoginButton.setEnabled(true);
                }
            }

            public void afterTextChanged(Editable s) {
            }
        });
        this.etPassword.addTextChangedListener(new TextWatcher() {
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
            }

            public void onTextChanged(CharSequence s, int start, int before, int count) {
                if (Login.this.etEmail.getText().toString().length() <= 0 || Login.this.etPassword.getText().toString().length() <= 0) {
                    Login.this.mLoginButton.setEnabled(false);
                } else {
                    Login.this.mLoginButton.setEnabled(true);
                }
            }

            public void afterTextChanged(Editable s) {
            }
        });
    }

    public void onAnimationStart(Animation animation) {
    }

    public void onAnimationEnd(Animation animation) {
        this.mFbLogoStaticImageView.setVisibility(View.VISIBLE);
        this.mFbLogoImageView.clearAnimation();
        this.mFbLogoImageView.setVisibility(View.GONE);
        this.etEmail.setAlpha(0.0f);
        this.etEmail.setVisibility(View.VISIBLE);
        this.etPassword.setAlpha(0.0f);
        this.etPassword.setVisibility(View.VISIBLE);
        this.mAppName.setAlpha(0.0f);
        this.mAppName.setVisibility(View.VISIBLE);
        this.mForgotPswTextView.setAlpha(0.0f);
        this.mForgotPswTextView.setVisibility(View.VISIBLE);
        this.mLoginButton.setAlpha(0.0f);
        this.mLoginButton.setVisibility(View.VISIBLE);
        if (getResources().getConfiguration().orientation == 1) {
            this.mFbCoverImageView.setAlpha(0.0f);
            this.mFbCoverImageView.setVisibility(View.VISIBLE);
        }
        int mediumAnimationTime = 2000;
        this.etEmail.animate().alpha(1.0f).setDuration((long) mediumAnimationTime).setListener(null);
        this.etPassword.animate().alpha(1.0f).setDuration((long) mediumAnimationTime).setListener(null);
        this.mAppName.animate().alpha(1.0f).setDuration((long) mediumAnimationTime).setListener(null);
        this.mForgotPswTextView.animate().alpha(1.0f).setDuration((long) mediumAnimationTime).setListener(null);
        this.mLoginButton.animate().alpha(1.0f).setDuration((long) mediumAnimationTime).setListener(null);
        if (getResources().getConfiguration().orientation == 1) {
            this.mFbCoverImageView.animate().alpha(1.0f).setDuration((long) mediumAnimationTime).setListener(null);
        }
        this.ANIMATION_ENDED = Boolean.valueOf(true);
    }

    public void onAnimationRepeat(Animation animation) {
    }

    public static float dpToPx(Context context, float valueInDp) {
        return TypedValue.applyDimension(1, valueInDp, context.getResources().getDisplayMetrics());
    }

    /* Access modifiers changed, original: protected */
    public void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);
        outState.putBoolean("START_ANIMATION", false);
    }

    private void requestLogin() {
        if (this.mAwesomeValidation.validate()) {
            AlertDialog dialog = new SpotsDialog(this.mContext);
            this.spinner.setVisibility(View.VISIBLE);
            this.mBas.loginRequest(this.etEmail.getText().toString(), this.etPassword.getText().toString()).enqueue(new Callback<ResponseAuth>() {
                public void onResponse(Call<ResponseAuth> call, Response<ResponseAuth> response) {
                    if (((ResponseAuth) response.body()).getStatus().equals("Success")) {
                        Login.this.spinner.setVisibility(View.GONE);
                        String name = ((ResponseAuth) response.body()).getData().getName();
                        String email = ((ResponseAuth) response.body()).getData().getEmail();
                        String user_id = ((ResponseAuth) response.body()).getData().getUserId();
                        String user_type = ((ResponseAuth) response.body()).getData().getUserType();
                        String kd_pihk = ((ResponseAuth) response.body()).getData().getKodePihk();
                        Prefs.putString("name", name);
                        Prefs.putString("email", email);
                        Prefs.putString("kd_pihk", "3001");
                        Prefs.putString("user_type", user_type);
                        Prefs.putInt("user_id", Integer.parseInt(user_id));
                        if (user_type.equals("admin")) {
                            Login.this.startActivity(new Intent(Login.this, AdminNavigationActivity.class));
                            Login.this.finish();
                            return;
                        }
                        Login.this.startActivity(new Intent(Login.this, DevMainActivity.class));
                        Login.this.finish();
                        return;
                    }
                    Login.this.spinner.setVisibility(View.GONE);
                    Toast.makeText(Login.this, "Login Error", Toast.LENGTH_SHORT).show();
                }

                public void onFailure(Call<ResponseAuth> call, Throwable t) {
                    Log.e(BuildConfig.BUILD_TYPE, "onFailure: ERROR > " + t.toString());
                    Login.this.spinner.setVisibility(View.GONE);
                }
            });
        }
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() != 16908332) {
            return super.onOptionsItemSelected(item);
        }
        Intent startMain = new Intent("android.intent.action.MAIN");
        startMain.addCategory("android.intent.category.HOME");
        startMain.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        startMain.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startMain.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        startActivity(startMain);
        finish();
        if (VERSION.SDK_INT >= 16) {
            finishAffinity();
        }
        return true;
    }

}
