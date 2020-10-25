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

public class Get_User_Info_B  extends AppCompatActivity {

    SharedPreferences sharedPreferences;
    DatabaseReference rootref;
    Button manBtn;
    Button womanBtn;
    Button bothBtn;

    String user_id;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_get_user_info_interest);

        manBtn=findViewById(R.id.btnMan);
        manBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Call_Api(user_id,
                        0);
            }
        });

        womanBtn=findViewById(R.id.btnWomen);
        womanBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Call_Api(user_id,
                        1);
            }
        });

        bothBtn=findViewById(R.id.btnBoth);
        bothBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Call_Api(user_id,
                        2);
            }
        });

    }

    // this method will store the info of user to  database
    private void Call_Api(String user_id,
                                     int selectedCategory
                                     ) {
        if (selectedCategory == 0)
            com.qboxus.binder.Main_Menu.MainMenuActivity.sharedPreferences.edit().putString(com.qboxus.binder.CodeClasses.Variables.show_me,"male").commit();
        if (selectedCategory == 1)
            com.qboxus.binder.Main_Menu.MainMenuActivity.sharedPreferences.edit().putString(com.qboxus.binder.CodeClasses.Variables.show_me,"female").commit();
        if (selectedCategory == 2)
            com.qboxus.binder.Main_Menu.MainMenuActivity.sharedPreferences.edit().putString(com.qboxus.binder.CodeClasses.Variables.show_me,"all").commit();

        get_user_info_describe();
        /*
        JSONObject parameters = new JSONObject();
        try {
            parameters.put("fb_id", user_id);
            parameters.put("selected_interest",selectedCategory);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        com.qboxus.binder.CodeClasses.Functions.generateNoteOnSD("parameters",parameters.toString());

        com.qboxus.binder.CodeClasses.ApiRequest.Call_Api(this, com.qboxus.binder.CodeClasses.Variables.SignUpInterest, parameters, new com.qboxus.binder.CodeClasses.Callback() {
            @Override
            public void Responce(String resp) {
                com.qboxus.binder.CodeClasses.Functions.cancel_loader();
                Parse_return_data(resp);
            }
        });
        */
    }


    // if the signup successfull then this method will call and it store the user info in local
    public void Parse_return_data(String returnData){
        try {
            JSONObject jsonObject=new JSONObject(returnData);
            String code=jsonObject.optString("code");
            if(code.equals("200")){
                JSONArray jsonArray=jsonObject.getJSONArray("msg");
                JSONObject userdata = jsonArray.getJSONObject(0);
                SharedPreferences.Editor editor=sharedPreferences.edit();
                editor.commit();
                // after all things done we will move another user asking screen
                get_user_info_describe();
                //enable_location();
            }else {
                Toast.makeText(this, ""+jsonObject.optString("msg"), Toast.LENGTH_SHORT).show();
            }

        } catch (JSONException e) {
            com.qboxus.binder.CodeClasses.Functions.cancel_loader();
            e.printStackTrace();
        }

    }



    private void get_user_info_describe()
    {

        Intent intent=new Intent(Get_User_Info_B.this, Get_User_Info_C.class);
        intent.putExtra("id",user_id);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
        finishAffinity();
    }
}


