package com.qboxus.pepinder.Accounts;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
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

    EditText describeAbout,describeLookingfor;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_get_user_info_describe);

        continueBtn=findViewById(R.id.btnContinue);

        describeAbout=findViewById(R.id.first_name);
        describeLookingfor=findViewById(R.id.last_name);

        continueBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String about= describeAbout.getText().toString();
                String lookingfor=describeLookingfor.getText().toString();
                Context context = Get_User_Info_C.this;
                if(TextUtils.isEmpty(about)){

                    Toast.makeText(Get_User_Info_C.this, context.getResources().getString(R.string.toast_plz_write_describe), Toast.LENGTH_SHORT).show();

                } else if(TextUtils.isEmpty(lookingfor)){

                    Toast.makeText(Get_User_Info_C.this, context.getResources().getString(R.string.toast_plz_write_looking_for), Toast.LENGTH_SHORT).show();

                }
                Call_Api(user_id,
                        about,lookingfor);
            }
        });

    }

    // this method will store the info of user to  database
    private void Call_Api(String user_id,
                                     String about,String lookingfor
    ) {


        JSONObject parameters = new JSONObject();
        try {
            parameters.put("fb_id", user_id);
            parameters.put("about",about);
            parameters.put("lookingfor",lookingfor);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        com.qboxus.binder.CodeClasses.Functions.generateNoteOnSD("parameters",parameters.toString());
        com.qboxus.binder.CodeClasses.ApiRequest.Call_Api(this, com.qboxus.binder.CodeClasses.Variables.SignUpDescribe, parameters, new com.qboxus.binder.CodeClasses.Callback() {
            @Override
            public void Responce(String resp) {
                com.qboxus.binder.CodeClasses.Functions.cancel_loader();
                Parse_data(resp);
            }
        });

    }


    // if the signup successfull then this method will call and it store the user info in local
    public void Parse_data(String loginData){
        try {
            JSONObject jsonObject=new JSONObject(loginData);
            String code=jsonObject.optString("code");
            if(code.equals("200")){
                JSONArray jsonArray=jsonObject.getJSONArray("msg");
                JSONObject userdata = jsonArray.getJSONObject(0);
                SharedPreferences.Editor editor=sharedPreferences.edit();
                editor.commit();

                // after all things done we will move go to category screen
                get_user_info_category();
            }else {
                Toast.makeText(this, ""+jsonObject.optString("msg"), Toast.LENGTH_SHORT).show();
            }

        } catch (JSONException e) {
            com.qboxus.binder.CodeClasses.Functions.cancel_loader();
            e.printStackTrace();
        }

    }


    private void get_user_info_category()
    {
        Intent intent=new Intent(Get_User_Info_C.this, Get_User_Info_D.class);
        intent.putExtra("id",user_id);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
        finishAffinity();


    }
}


