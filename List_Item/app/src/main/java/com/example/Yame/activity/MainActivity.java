package com.example.Yame.activity;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.ListView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.Yame.Fragment.AllFragment;
import com.example.Yame.Fragment.PantFragmentDanhSach;
import com.example.Yame.Fragment.ShirtFragmentDanhSach;
import com.example.Yame.Fragment.ShortFragmentDanhSach;
import com.example.Yame.Fragment.TeeFragmentDanhSach;
import com.example.Yame.Model.GioHang;
import com.example.Yame.adapter.AdapterItem;
import com.example.Yame.Model.Item;
import com.example.list_item.R;
import com.example.Yame.ultil.checkConnection;
import com.google.android.material.navigation.NavigationView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity implements  NavigationView.OnNavigationItemSelectedListener {

    DrawerLayout drawerLayout;
    NavigationView navigationView;
    Toolbar toolbar;
    AdapterItem adapter;
    ImageButton btnTee;
    ImageButton btnShirt;
    ImageButton btnShort;
    ImageButton btnPants;
    ImageButton btnAll;
    public static List<GioHang> manggiohang;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Addcontrols();
        ActionBar();
        clickFrament();
        reFrament(new AllFragment());
    }

    private void clickFrament(){
        btnShort.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadFragment(new ShortFragmentDanhSach());
            }
        });
        btnTee.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadFragment(new TeeFragmentDanhSach());
            }
        });
        btnShirt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadFragment(new ShirtFragmentDanhSach());
            }
        });
        btnPants.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadFragment(new PantFragmentDanhSach());
            }
        });
        btnAll.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadFragment(new AllFragment());
            }
        });
    }
    private void reFrament(Fragment fragment) {
        FragmentTransaction transaction = getSupportFragmentManager().beginTransaction();
        transaction.replace(R.id.framelayout, fragment);
        transaction.commit();
    }

    private void loadFragment(Fragment fragment) {
        // create a FragmentManager
        FragmentManager fm = getSupportFragmentManager();
        // create a FragmentTransaction to begin the transaction and replace the Fragment
        FragmentTransaction fragmentTransaction = fm.beginTransaction();

        // replace the FrameLayout with new Fragment
        fragmentTransaction.replace(R.id.framelayout, fragment);
        fragmentTransaction.commit(); // save the changes
    }

    private void getDataProduct(String url, ArrayList arr){
        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET,url,null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                if (response != null){
                    String name = "";
                    String img = "";
                    int id, price = 0;
                    String detail ="";
                    for(int i = 0;i < response.length();i++){
                        try {
                            JSONObject jsonObject = response.getJSONObject(i);
                            id = jsonObject.getInt("MaSP");
                            name = jsonObject.getString("TenSP");
                            img = jsonObject.getString("HinhAnh");
                            price = jsonObject.getInt("DonGia");
                            detail = jsonObject.getString("ChiTiet");

                            arr.add(new Item(id,name,img,price,detail));
                            adapter.notifyDataSetChanged();
                        } catch (JSONException e) {
                            //Toast.makeText(MainActivity.this, "1", Toast.LENGTH_SHORT).show();
                            //throw new RuntimeException(e);
                        }
                    }
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                checkConnection.ShowToast(MainActivity.this,error.toString());
            }
        });
        requestQueue.add(jsonArrayRequest);
    }
    private void ActionBar() {
//        setSupportActionBar(toolbar);
//        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        //        setSupportActionBar(toolbar);
        ActionBarDrawerToggle actionBarDrawerToggle = new ActionBarDrawerToggle(this,
                drawerLayout, toolbar, R.string.nav_open, R.string.nav_close);
        drawerLayout.addDrawerListener(actionBarDrawerToggle);
        actionBarDrawerToggle.syncState();
        navigationView.setNavigationItemSelectedListener(this);
        navigationView.getMenu().findItem(R.id.nav_listsp).setChecked(true);
    }
    private void Addcontrols() {
        drawerLayout = (DrawerLayout) findViewById(R.id.draw);
        navigationView = (NavigationView) findViewById(R.id.navigation);
        btnShirt = findViewById(R.id.btnShirt);
        toolbar = (Toolbar)findViewById(R.id.toolbarHome);
        btnTee = findViewById(R.id.btnTee);
        btnShort = findViewById(R.id.btnShort);
        btnPants = findViewById(R.id.btnPants);
        btnAll =  findViewById(R.id.btnAll);
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        int id = item.getItemId();


        if (id == R.id.nav_listsp) {
            Intent listsp = new Intent(getApplicationContext(),MainActivity.class);
            startActivity(listsp);
            finish();
        }
        else if(id == R.id.nav_home) {
            Intent trangchu = new Intent(getApplicationContext(),frmTrangChu.class);
            startActivity(trangchu);
        }
        drawerLayout.closeDrawer(GravityCompat.START);
        return true;
    }


}