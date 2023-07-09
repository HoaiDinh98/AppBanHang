package com.example.Yame.activity;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.Yame.Model.Item;
import com.example.Yame.Model.User;
import com.example.Yame.ultil.Server;
import com.example.Yame.ultil.checkConnection;
import com.example.list_item.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class UserActivity extends AppCompatActivity {

    EditText txtHoTen, txtSDT, txtDiaChi, txtEmail;
    Button btnXacNhan, btnTroVe;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user);
        addControl();
        getDataUser();
        setFocusable();

        btnXacNhan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final String iduser = Server.user_current.getTk();
                final String sdt = txtSDT.getText().toString().trim();
                final String diaChi = txtDiaChi.getText().toString().trim();
                if (iduser.length() > 0 && sdt.length() > 0 && diaChi.length() > 0) {
                    RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
                    StringRequest stringRequest = new StringRequest(Request.Method.POST, Server.linkOrder, new Response.Listener<String>() {
                        @Override
                        public void onResponse(final String madonhang) {
                            RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
                            StringRequest request = new StringRequest(Request.Method.POST, Server.linkOrderDetails, new Response.Listener<String>() {
                                @Override
                                public void onResponse(String response) {
                                    if(response.equals("true")) {
                                        MainActivity.manggiohang.clear();
                                        Intent intent = new Intent(getApplicationContext(),MainActivity.class);
                                        startActivity(intent);
                                        checkConnection.ShowToast(getApplicationContext(),"Mời bạn tiếp tục mua sắm !!");
                                        checkConnection.ShowToast(getApplicationContext(),"Đã thêm dữ liệu giỏ hàng thành công !!");
                                    } else {
                                        checkConnection.ShowToast(getApplicationContext(),"Dữ liệu giỏ hàng đã bị lỗi");
                                    }
                                }
                            }, new Response.ErrorListener() {
                                @Override
                                public void onErrorResponse(VolleyError error) {

                                }
                            }){
                                @Override
                                protected Map<String, String> getParams() throws AuthFailureError {
                                    JSONArray jsonArray = new JSONArray();
                                    for(int i=0;i<MainActivity.manggiohang.size();i++)
                                    {
                                        JSONObject jsonObject = new JSONObject();
                                        try {
                                            jsonObject.put("iddon",madonhang);
                                            jsonObject.put("idsp",MainActivity.manggiohang.get(i).getIdSP());
                                            jsonObject.put("tensp",MainActivity.manggiohang.get(i).getTenSP());
                                            jsonObject.put("gia",MainActivity.manggiohang.get(i).getDonGia());
                                            jsonObject.put("soluong",MainActivity.manggiohang.get(i).getSoLuong());

                                        } catch (JSONException e) {
                                            e.printStackTrace();
                                        }
                                        jsonArray.put(jsonObject);
                                    }
                                    HashMap<String,String> hashMap = new HashMap<String, String>();
                                    hashMap.put("json",jsonArray.toString());
                                    return hashMap;
                                }
                            };
                            queue.add(request);
                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {

                        }
                    }){
                        @Override
                        protected Map<String, String> getParams() throws AuthFailureError {
                            HashMap<String,String> hashMap= new HashMap<String,String>();
                            hashMap.put("iduser",iduser);
                            hashMap.put("diachi",diaChi);
                            hashMap.put("sdt",sdt);
                            return hashMap;
                        }
                    };
                    requestQueue.add(stringRequest);
                } else {
                    checkConnection.ShowToast(getApplicationContext(), "Hãy kiểm tra lại dữ liệu !!");
                }
            }
        });

        btnTroVe.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }

    private void getDataUser(){
        StringRequest request = new StringRequest(Request.Method.POST, Server.linkUser, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                String str = response;
                String[] data = str.split("!");
                txtHoTen.setText(data[2]);
                txtSDT.setText(data[3]);
                txtDiaChi.setText(data[4]);
                txtEmail.setText(data[5]);

                Server.user_current.setTk(data[0]);
                Server.user_current.setMk(data[1]);
                Server.user_current.setHoTen(data[2]);
                Server.user_current.setSdt(data[3]);
                Server.user_current.setDiaChi(data[4]);
                Server.user_current.setEmail(data[5]);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();
            }
        }
        ){
            protected Map<String,String> getParams() throws AuthFailureError {
                Map<String,String> map = new HashMap<String,String>();
                map.put("TenTK", Server.user_current.getTk());
                return map;
            }
        };
        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        queue.add(request);
    }

    private void setFocusable() {
        // ham tat chinh sua edt
        txtHoTen.setFocusable(false);
        txtEmail.setFocusable(false);
        txtSDT.setFocusable(false);
        txtDiaChi.setFocusable(false);
    }

    private void setFocusableInTouchMode() {
        // ham bat chinh sua edt
        txtHoTen.setFocusableInTouchMode(true);
        txtEmail.setFocusableInTouchMode(true);
        txtSDT.setFocusableInTouchMode(true);
        txtDiaChi.setFocusableInTouchMode(true);
    }

    public void addControl()
    {
        txtHoTen = (EditText) findViewById(R.id.edtTenKH);
        txtSDT = (EditText) findViewById(R.id.edtSDT);
        txtDiaChi = (EditText) findViewById(R.id.edtDiaChi);
        txtEmail = (EditText) findViewById(R.id.edtEmail);

        btnXacNhan = (Button) findViewById(R.id.btnXacNhan);
        btnTroVe = (Button) findViewById(R.id.btnTroVe);
    }
}