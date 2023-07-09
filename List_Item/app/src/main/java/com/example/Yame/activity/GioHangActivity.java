package com.example.Yame.activity;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;

import android.view.View;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import com.example.Yame.Model.GioHang;
import com.example.Yame.adapter.GioHangAdapter;
import com.example.Yame.ultil.checkConnection;
import com.example.list_item.R;

import java.text.DecimalFormat;
import java.util.ArrayList;

public class GioHangActivity extends AppCompatActivity {
    ListView lstViewGioHang;
    TextView txtThongBao;
    static TextView txtTongTien;
    Button btnThanhToan, btnTiepTuc;
    Toolbar toolbargiohang;
    ArrayList<GioHang> arrayListGioHang;
    GioHangAdapter giohangAdapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_giohang);
        anhxa();
        actionToolbar();
        checkData();
        evenUltil();
        DeleteItem();
        eventButton();
    }

    private void eventButton() {
        btnTiepTuc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent =new Intent(getApplicationContext(),MainActivity.class);
                startActivity(intent);
            }
        });
        btnThanhToan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (MainActivity.manggiohang.size() > 0) {
                    Intent intent = new Intent(getApplicationContext(),UserActivity.class);
                    startActivity(intent);
                } else {
                    checkConnection.ShowToast(getApplicationContext(),"Giỏ hàng của bạn chưa có sản phẩm để thanh toán");
                }
            }
        });
    }

    private void DeleteItem() {
        lstViewGioHang.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener() {
            @Override
            public boolean onItemLongClick(AdapterView<?> parent, View view, final int position, long id) {
                AlertDialog.Builder builder=new AlertDialog.Builder(GioHangActivity.this);
                builder.setTitle("Xác nhận xóa sản phẩm");
                builder.setMessage("Bạn có chắc chắn xóa sản phẩm này ?");
                builder.setPositiveButton("Có", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                       if(MainActivity.manggiohang.size()<=0){
                           txtThongBao.setVisibility(View.VISIBLE);
                       }else {
                           MainActivity.manggiohang.remove(position);
                           giohangAdapter.notifyDataSetChanged();
                           evenUltil();
                           if(MainActivity.manggiohang.size()<=0){
                               txtThongBao.setVisibility(View.VISIBLE);
                           }else{
                               txtThongBao.setVisibility(View.INVISIBLE);
                               giohangAdapter.notifyDataSetChanged();
                               evenUltil();
                           }
                       }
                    }
                });
                builder.setNegativeButton("Không", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                      giohangAdapter.notifyDataSetChanged();
                      evenUltil();
                    }
                });
                builder.show();
                return true;
            }
        });
    }

    public static void evenUltil() {
        float tongtien=30000;
        for(int i=0; i<MainActivity.manggiohang.size(); i++){
            tongtien+=MainActivity.manggiohang.get(i).getDonGia();
        }
        DecimalFormat decimalFormat =new DecimalFormat("###,###,###");
        txtTongTien.setText(decimalFormat.format(tongtien)+ "VNĐ");
    }

    private void checkData() {
        if(MainActivity.manggiohang.size()<=0){
            giohangAdapter.notifyDataSetChanged();
            txtThongBao.setVisibility(View.VISIBLE);
            lstViewGioHang.setVisibility(View.INVISIBLE);
        }else{
            giohangAdapter.notifyDataSetChanged();
            txtThongBao.setVisibility(View.INVISIBLE);
            lstViewGioHang.setVisibility(View.VISIBLE);
        }
    }

    private void actionToolbar() {
        setSupportActionBar(toolbargiohang);
        ActionBar actionBar=getSupportActionBar();
        actionBar.setDisplayHomeAsUpEnabled(true);
        toolbargiohang.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });
    }

    private void anhxa() {
        arrayListGioHang = (ArrayList<GioHang>) MainActivity.manggiohang;
        lstViewGioHang =findViewById(R.id.lstViewGioHang);
        txtThongBao =findViewById(R.id.txtThongBaoGioHangRong);
        txtTongTien =findViewById(R.id.txtTongTien);
        btnThanhToan =findViewById(R.id.btnThanhToan);
        btnTiepTuc =findViewById(R.id.btnTiepTuc);
        toolbargiohang=findViewById(R.id.toolbarGioHang);
        giohangAdapter=new GioHangAdapter((Context) GioHangActivity.this, arrayListGioHang);
        lstViewGioHang.setAdapter(giohangAdapter);
    }
}
