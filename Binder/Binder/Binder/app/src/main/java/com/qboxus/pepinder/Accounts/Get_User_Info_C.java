package com.qboxus.pepinder.Accounts;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.qboxus.binder.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class Get_User_Info_C  extends AppCompatActivity {

    SharedPreferences sharedPreferences;
    DatabaseReference rootref;
    Button continueBtn;

    String user_id;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_get_user_info_describe);

        continueBtn=findViewById(R.id.btnContinue);

        continueBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Call_Api(user_id,
                        0);
            }
        });

    }

    // this method will store the info of user to  database
    private void Call_Api(String user_id,
                                     int selectedCategory
    ) {


        JSONObject parameters = new JSONObject();
        try {
            parameters.put("fb_id", user_id);
            parameters.put("selected_interest",selectedCategory);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        com.qboxus.binder.CodeClasses.Functions.generateNoteOnSD("parameters",parameters.toString());
        get_user_info_lookingfor();
        /*com.qboxus.binder.CodeClasses.ApiRequest.Call_Api(this, com.qboxus.binder.CodeClasses.Variables.SignUp, parameters, new com.qboxus.binder.CodeClasses.Callback() {
            @Override
            public void Responce(String resp) {
                com.qboxus.binder.CodeClasses.Functions.cancel_loader();
                Parse_signup_data(resp);
            }
        });
        */
    }

    /*
    // if the signup successfull then this method will call and it store the user info in local
    public void Parse_signup_data(String loginData){
        try {
            JSONObject jsonObject=new JSONObject(loginData);
            String code=jsonObject.optString("code");
            if(code.equals("200")){
                JSONArray jsonArray=jsonObject.getJSONArray("msg");
                JSONObject userdata = jsonArray.getJSONObject(0);
                SharedPreferences.Editor editor=sharedPreferences.edit();
                editor.putString(com.qboxus.binder.CodeClasses.Variables.uid,userdata.optString("fb_id"));
                editor.putString(com.qboxus.binder.CodeClasses.Variables.f_name,userdata.optString("first_name"));
                editor.putString(com.qboxus.binder.CodeClasses.Variables.l_name,userdata.optString("last_name"));
                editor.putString(com.qboxus.binder.CodeClasses.Variables.birth_day,userdata.optString("age"));
                editor.putString(com.qboxus.binder.CodeClasses.Variables.gender,userdata.optString("gender"));
                editor.putString(com.qboxus.binder.CodeClasses.Variables.u_pic,userdata.optString("image1"));
                editor.putBoolean(com.qboxus.binder.CodeClasses.Variables.islogin,true);
                editor.commit();

                // after all things done we will move the user to enable location screen
                get_user_info_interest();
                //enable_location();
            }else {
                Toast.makeText(this, ""+jsonObject.optString("msg"), Toast.LENGTH_SHORT).show();
            }

        } catch (JSONException e) {
            com.qboxus.binder.CodeClasses.Functions.cancel_loader();
            e.printStackTrace();
        }

    }

     */

    private void get_user_info_lookingfor()
    {
        Intent intent=new Intent(Get_User_Info_C.this, Get_User_Info_D.class);
        intent.putExtra("id",user_id);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
        finishAffinity();


    }
}


