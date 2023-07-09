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
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.Toast;
import android.widget.ViewFlipper;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;
import com.example.Yame.Fragment.ShirtFragment;
import com.example.Yame.Fragment.TeeFragment;
import com.example.Yame.Model.Item;
import com.example.Yame.adapter.SanPhamAdapter;
import com.example.Yame.ultil.Server;
import com.example.Yame.ultil.checkConnection;
import com.example.Yame.Fragment.PantFragment;
import com.example.list_item.R;
import com.example.Yame.Fragment.ShortFragment;
import com.google.android.material.navigation.NavigationView;
import com.nex3z.notificationbadge.NotificationBadge;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class frmTrangChu extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {
    DrawerLayout drawerLayout;
    NavigationView navigationView;
    RecyclerView recyclerViewHome;
    Toolbar toolbar;
    ViewFlipper viewFlipper;
    ArrayList<Item> arr;
    SanPhamAdapter adapter;
    ImageButton imgbtn_AoThun, imgbtn_Short, imgbtn_Shirt, imgbtn_Pant;
    NotificationBadge badge;
    FrameLayout frameLayoutGioHang;

    ImageView imgSearch;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_frm_trang_chu);
        Addcontrols();
        ActionBar();
        ActionViewLipper();
        getDataProduct();
        clickFrament();

        reFrament(new ShortFragment());
    }
    private void clickFrament(){
        imgbtn_Short.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadFragment(new ShortFragment());

            }
        });
        imgbtn_AoThun.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadFragment(new TeeFragment());
            }
        });
        imgbtn_Shirt.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadFragment(new ShirtFragment());
            }
        });
        imgbtn_Pant.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadFragment(new PantFragment());
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
    private void getDataProduct(){
        arr = new ArrayList<>();
        adapter = new SanPhamAdapter(getApplicationContext(),arr);
        recyclerViewHome.setAdapter(adapter);
        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, Server.linkProductNew,null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                if (response != null){
                    String name = "";
                    String img = "";
                    int id = 0;
                    int price = 0;
                    String detail ="";
                    for(int i = 0;i < response.length();i++){
                        try {
                            JSONObject jsonObject = response.getJSONObject(i);
                            id = jsonObject.getInt("MaSp");
                            name = jsonObject.getString("TenSP");
                            img = jsonObject.getString("HinhAnh");
                            price = jsonObject.getInt("DonGia");
                            detail = jsonObject.getString("ChiTiet");

                            arr.add(new Item(id,name,img,price,detail));
                            adapter.notifyDataSetChanged();
                        } catch (JSONException e) {
                            Toast.makeText(frmTrangChu.this, "1", Toast.LENGTH_SHORT).show();
                            throw new RuntimeException(e);
                        }
                    }
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                checkConnection.ShowToast(frmTrangChu.this,error.toString());
            }
        });
        requestQueue.add(jsonArrayRequest);
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        int id = item.getItemId();

        if (id == R.id.nav_listsp) {
            Intent listsp = new Intent(getApplicationContext(),MainActivity.class);
            startActivity(listsp);
        }
        else if(id == R.id.nav_home) {
            Intent trangchu = new Intent(getApplicationContext(),frmTrangChu.class);
            startActivity(trangchu);
            finish();
        }
        else if(id == R.id.nav_infor) {
            Intent user = new Intent(getApplicationContext(), UserActivity.class);
            startActivity(user);
        }
        else if(id == R.id.nav_logout) {
            Intent logout = new Intent(getApplicationContext(), LoginActivity.class);
            startActivity(logout);
        }
        drawerLayout.closeDrawer(GravityCompat.START);
        return true;
    }

    private void ActionBar() {
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        //        setSupportActionBar(toolbar);
        ActionBarDrawerToggle actionBarDrawerToggle = new ActionBarDrawerToggle(this,
                drawerLayout, toolbar, R.string.nav_open, R.string.nav_close);
        drawerLayout.addDrawerListener(actionBarDrawerToggle);
        actionBarDrawerToggle.syncState();

        navigationView.setNavigationItemSelectedListener(this);

        navigationView.getMenu().findItem(R.id.nav_home).setChecked(true);



    }
    private void Addcontrols() {
        drawerLayout = (DrawerLayout) findViewById(R.id.draw);
        navigationView = (NavigationView) findViewById(R.id.navigation);
        toolbar = (Toolbar)findViewById(R.id.toolbarHome);
        viewFlipper = findViewById(R.id.viewFlipper);
        recyclerViewHome = findViewById(R.id.recyclerView);
        GetNgangREcyle(recyclerViewHome);
        imgbtn_Short = (ImageButton) findViewById(R.id.imgbtn_Short);
        imgbtn_AoThun = (ImageButton) findViewById(R.id.imgbtn_AoThun);
        imgbtn_Shirt = (ImageButton) findViewById(R.id.imgbtn_Shirt);
        imgbtn_Pant = (ImageButton) findViewById(R.id.imgbtn_jean);
        badge = findViewById(R.id.menu_sl);
        frameLayoutGioHang = findViewById(R.id.frameGioHang);
        imgSearch = (ImageView) findViewById(R.id.imgSearch);

        if (MainActivity.manggiohang == null) {
            MainActivity.manggiohang = new ArrayList<>();
        } else {
            int sum = 0;
            for(int i=0;i<MainActivity.manggiohang.size();i++) {
                sum += MainActivity.manggiohang.get(i).getSoLuong();
            }
            badge.setText(String.valueOf(sum));
        }

        frameLayoutGioHang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getApplicationContext(), GioHangActivity.class);
                startActivity(intent);
            }
        });

        imgSearch.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getApplicationContext(), SearchActivity.class);
                startActivity(intent);
            }
        });

    }

    private  void GetNgangREcyle(RecyclerView temp){
        Context context = this;
        int orientation = LinearLayoutManager.HORIZONTAL; //Cuộn ngang
        boolean reverse = false;
        LinearLayoutManager layoutManager = new LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL, false);
        layoutManager.scrollToPosition(0);
        temp.setLayoutManager(layoutManager);
        temp.setHasFixedSize(true);
    }
    private  void GetDungREcyle(RecyclerView temp){
      RecyclerView.LayoutManager layoutManager = new GridLayoutManager(this,2);
        temp.setLayoutManager(layoutManager);
    }
    @Override
    public void onBackPressed() {
        if (drawerLayout.isDrawerOpen(GravityCompat.START)) {
            drawerLayout.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }
    private void ActionViewLipper() {
        List<String> mangquangcao = new ArrayList<>();
        mangquangcao.add("https://www.celeb.vn/wp-content/uploads/2021/09/yame-store-e1630470249766.jpg");
        mangquangcao.add("https://hocmay.vn/wp-content/uploads/2022/12/shop-quan-ao-nam-tphcm-yame.jpg");
        mangquangcao.add("https://uploads-ssl.webflow.com/6173aa1bfd82711c106c922c/62a9ccee28803b6bc841a84c_62434547ebabf01f0e1aa4c0_screenshot_1648575788.png");
        mangquangcao.add("https://cdn2.yame.vn/cimg/back-to-school/813469fe-166c-0300-c4d4-0014e2eb1a39.jpg");
        mangquangcao.add("https://chonthuonghieu.com/wp-content/uploads/listing-uploads/cover/2020/12/yame-shop-316910.jpg");
        for ( int i = 0; i < mangquangcao.size(); i++){
            ImageView imageView = new ImageView(getApplicationContext());

            Glide.with(getApplicationContext()).load(mangquangcao.get(i)).into(imageView);
            imageView.setScaleType(ImageView.ScaleType.FIT_XY);
            viewFlipper.addView(imageView);

        }
        viewFlipper.setFlipInterval(3000);
        viewFlipper.setAutoStart(true);
        Animation slide_in = AnimationUtils.loadAnimation(getApplicationContext(),R.anim.slide_in_right);
        Animation slide_out = AnimationUtils.loadAnimation(getApplicationContext(),R.anim.siler_out_right);
        viewFlipper.setInAnimation(slide_in);
        viewFlipper.setOutAnimation(slide_out);

    }
}