package com.example.Yame.activity;

import android.content.Intent;
import android.icu.text.DecimalFormat;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import com.bumptech.glide.Glide;
import com.example.Yame.Model.GioHang;
import com.example.Yame.Model.Item;
import com.example.list_item.R;
import com.nex3z.notificationbadge.NotificationBadge;


public class ChiTietSPActivity extends AppCompatActivity {

    Toolbar toolbarChitet;
    TextView tensp, giasp, mota;
    Button btn_them;
    Spinner spinner;
    ImageView imagHinhAnh;
    Item ctsp;
    NotificationBadge badge;

    FrameLayout frameLayoutGioHang;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chitietsp);
        initView();
        ActionBar();
        initData();
        themSPVaoGio();


    }

    private void initView () {
        tensp = findViewById(R.id.txt_tensp);
        giasp = findViewById(R.id.txt_giasp);
        mota = findViewById(R.id.txt_motasp);
        btn_them = findViewById(R.id.btn_them);
        spinner = findViewById(R.id.spinner);
        imagHinhAnh = findViewById(R.id.ima_chitiet);
        toolbarChitet = findViewById(R.id.toolbar_ctsp);
        badge = findViewById(R.id.menu_sl);
        if (MainActivity.manggiohang != null) {
            int sum = 0;
            for(int i=0;i<MainActivity.manggiohang.size();i++) {
                sum += MainActivity.manggiohang.get(i).getSoLuong();
            }
            badge.setText(String.valueOf(sum));
        }
        frameLayoutGioHang = findViewById(R.id.frameGioHang);
        frameLayoutGioHang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getApplicationContext(), GioHangActivity.class);
                startActivity(intent);
            }
        });

    }
    private void ActionBar() {
        setSupportActionBar(toolbarChitet);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbarChitet.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }

    private void initData(){
        ctsp = ctsp = (Item) getIntent().getSerializableExtra("chitiet");
        tensp.setText(ctsp.getName());
        Glide.with(getApplicationContext()).load(ctsp.getImg()).into(imagHinhAnh);
        DecimalFormat decimalFormat = new DecimalFormat("###,###,###");
        giasp.setText("Giá: "+decimalFormat.format(Double.parseDouble(String.valueOf( ctsp.getPrice())))+" đ");
        mota.setText(ctsp.getDetail());
        Integer[] so = new Integer[]{1,2,3,4,5,6,7,8,9,10};
        ArrayAdapter<Integer> adapterspin = new ArrayAdapter<>(this, androidx.appcompat.R.layout.support_simple_spinner_dropdown_item,so);
        spinner.setAdapter(adapterspin);

    }

    private void themSPVaoGio() {
        btn_them.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(MainActivity.manggiohang.size() > 0){
                    int sl =Integer.parseInt(spinner.getSelectedItem().toString());
                    boolean flag = false;
                    for(int i=0;i<MainActivity.manggiohang.size();i++) {
                        if(MainActivity.manggiohang.get(i).getIdSP() == ctsp.getId()) {
                            MainActivity.manggiohang.get(i).setSoLuong(sl + MainActivity.manggiohang.get(i).getSoLuong());
                            int gia = ctsp.getPrice() * MainActivity.manggiohang.get(i).getSoLuong();
                            MainActivity.manggiohang.get(i).setDonGia(gia);
                            flag = true;
                        }
                    }
                    if(flag==false) {
                        int gia = ctsp.getPrice() * sl;
                        GioHang gioHang = new GioHang();
                        gioHang.setDonGia(gia);
                        gioHang.setSoLuong(sl);
                        gioHang.setIdSP(ctsp.getId());
                        gioHang.setTenSP(ctsp.getName());
                        gioHang.setAnhSP(ctsp.getImg());
                        MainActivity.manggiohang.add(gioHang);
                    }
                }
                else {
                    int sl =Integer.parseInt(spinner.getSelectedItem().toString());
                    int gia = ctsp.getPrice() * sl;
                    GioHang gioHang = new GioHang();
                    gioHang.setDonGia(gia);
                    gioHang.setSoLuong(sl);
                    gioHang.setIdSP(ctsp.getId());
                    gioHang.setTenSP(ctsp.getName());
                    gioHang.setAnhSP(ctsp.getImg());
                    MainActivity.manggiohang.add(gioHang);
                }

                if (MainActivity.manggiohang != null) {
                    int sum = 0;
                    for(int i=0;i<MainActivity.manggiohang.size();i++) {
                        sum += MainActivity.manggiohang.get(i).getSoLuong();
                    }
                    badge.setText(String.valueOf(sum));
                }
            }
        });
    }
}
