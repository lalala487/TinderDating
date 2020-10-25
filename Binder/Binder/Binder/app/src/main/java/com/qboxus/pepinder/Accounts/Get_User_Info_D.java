package com.qboxus.pepinder.Accounts;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.qboxus.binder.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import com.qboxus.binder.Accounts.Enable_location_A;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class Get_User_Info_D  extends AppCompatActivity {

    SharedPreferences sharedPreferences;
    DatabaseReference rootref;
    Button continueBtn;

    String user_id;

    private ListView mainListView ;
    private Planet[] planets ;
    private ArrayAdapter<Planet> listAdapter ;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_get_user_info_select_enjoyment);

        continueBtn=findViewById(R.id.btnContinue);

        continueBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // check or uncheck
                boolean isChecked = false;
                Context context = Get_User_Info_D.this;
                for (int i =0; i< planets.length; i++)
                {
                    Planet one = planets[i];
                    if (one.checked == true)
                        isChecked = true;
                }
                if (isChecked == false)
                    Toast.makeText(Get_User_Info_D.this,context.getResources().getString(R.string.toast_plz_select_enjoyment), Toast.LENGTH_SHORT).show();
                Call_Api(user_id);
            }
        });

        // Find the ListView resource.
        mainListView = (ListView) findViewById( R.id.listCheck );

        // When item is tapped, toggle checked properties of CheckBox and Planet.
        mainListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick( AdapterView<?> parent, View item,
                                     int position, long id) {
                Planet planet = listAdapter.getItem( position );
                planet.toggleChecked();
                PlanetViewHolder viewHolder = (PlanetViewHolder) item.getTag();
                viewHolder.getCheckBox().setChecked( planet.isChecked() );
            }
        });


        // Create and populate planets.
        planets = (Planet[]) getLastNonConfigurationInstance() ;
        if ( planets == null ) {
            planets = new Planet[] {
                    new Planet("Discretion"), new Planet("Open relationship"), new Planet("Flexible schedule"),
                    new Planet("Long-term"), new Planet("Romance"), new Planet("Friends with benefits"),
                    new Planet("Seeking trangender"), new Planet("Emotinoal connection"), new Planet("Short term"),
                    new Planet("Good dinner"), new Planet("Nothing serious"), new Planet("One night adventure")
            };
        }
        ArrayList<Planet> planetList = new ArrayList<Planet>();
        planetList.addAll( Arrays.asList(planets) );

        // Set our custom array adapter as the ListView's adapter.
        listAdapter = new PlanetArrayAdapter(this, planetList);
        mainListView.setAdapter( listAdapter );

    }

    /** Holds planet data. */
    private static class Planet {
        private String name = "" ;
        private boolean checked = false ;
        public Planet() {}
        public Planet( String name ) {
            this.name = name ;
        }
        public Planet( String name, boolean checked ) {
            this.name = name ;
            this.checked = checked ;
        }
        public String getName() {
            return name;
        }
        public void setName(String name) {
            this.name = name;
        }
        public boolean isChecked() {
            return checked;
        }
        public void setChecked(boolean checked) {
            this.checked = checked;
        }
        public String toString() {
            return name ;
        }
        public void toggleChecked() {
            checked = !checked ;
        }
    }

    /** Holds child views for one row. */
    private static class PlanetViewHolder {
        private CheckBox checkBox ;
        private TextView textView ;
        public PlanetViewHolder() {}
        public PlanetViewHolder( TextView textView, CheckBox checkBox ) {
            this.checkBox = checkBox ;
            this.textView = textView ;
        }
        public CheckBox getCheckBox() {
            return checkBox;
        }
        public void setCheckBox(CheckBox checkBox) {
            this.checkBox = checkBox;
        }
        public TextView getTextView() {
            return textView;
        }
        public void setTextView(TextView textView) {
            this.textView = textView;
        }
    }

    /** Custom adapter for displaying an array of Planet objects. */
    private static class PlanetArrayAdapter extends ArrayAdapter<Planet> {

        private LayoutInflater inflater;

        public PlanetArrayAdapter(Context context, List<Planet> planetList) {
            super(context, R.layout.row_item_view_checkentertainment, R.id.rowTextView, planetList);
            // Cache the LayoutInflate to avoid asking for a new one each time.
            inflater = LayoutInflater.from(context);
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            // Planet to display
            Planet planet = (Planet) this.getItem(position);

            // The child views in each row.
            CheckBox checkBox;
            TextView textView;

            // Create a new row view
            if (convertView == null) {
                convertView = inflater.inflate(R.layout.row_item_view_checkentertainment, null);

                // Find the child views.
                textView = (TextView) convertView.findViewById(R.id.rowTextView);
                checkBox = (CheckBox) convertView.findViewById(R.id.CheckBox01);

                // Optimization: Tag the row with it's child views, so we don't have to
                // call findViewById() later when we reuse the row.
                convertView.setTag(new PlanetViewHolder(textView, checkBox));

                // If CheckBox is toggled, update the planet it is tagged with.
                checkBox.setOnClickListener(new View.OnClickListener() {
                    public void onClick(View v) {
                        CheckBox cb = (CheckBox) v;
                        Planet planet = (Planet) cb.getTag();
                        planet.setChecked(cb.isChecked());
                    }
                });
            }
            // Reuse existing row view
            else {
                // Because we use a ViewHolder, we avoid having to call findViewById().
                PlanetViewHolder viewHolder = (PlanetViewHolder) convertView.getTag();
                checkBox = viewHolder.getCheckBox();
                textView = viewHolder.getTextView();
            }

            // Tag the CheckBox with the Planet it is displaying, so that we can
            // access the planet in onClick() when the CheckBox is toggled.
            checkBox.setTag(planet);

            // Display planet data
            checkBox.setChecked(planet.isChecked());
            textView.setText(planet.getName());

            return convertView;
        }
    }
        // this method will store the info of user to  database
    private void Call_Api(String user_id
    ) {


        JSONObject parameters = new JSONObject();
        try {
            parameters.put("fb_id", user_id);

            String selNameList = "";
            for (int i =0; i< planets.length; i++)
            {
                Planet one = planets[i];
                if (one.checked == true)
                {
                    selNameList =  selNameList + "," + one.getName();
                }
            }

            parameters.put("selected_category",selNameList);
        } catch (JSONException e) {
            e.printStackTrace();
        }

        com.qboxus.binder.CodeClasses.Functions.generateNoteOnSD("parameters",parameters.toString());
        com.qboxus.binder.CodeClasses.ApiRequest.Call_Api(this, com.qboxus.binder.CodeClasses.Variables.SignUp, parameters, new com.qboxus.binder.CodeClasses.Callback() {
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

                // after all things done we will move the user to enable location screen
                enable_location();
            }else {
                Toast.makeText(this, ""+jsonObject.optString("msg"), Toast.LENGTH_SHORT).show();
            }

        } catch (JSONException e) {
            com.qboxus.binder.CodeClasses.Functions.cancel_loader();
            e.printStackTrace();
        }

    }


    private void enable_location() {

        // will move the user for enable location screen
        startActivity(new Intent(this, Enable_location_A.class));
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
        finishAffinity();

    }
}


