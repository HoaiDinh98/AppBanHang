package com.example.Yame.activity;

import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.Yame.ultil.Server;
import com.example.list_item.R;

import java.util.HashMap;
import java.util.Map;
import java.util.regex.Pattern;


public class RegisterActivity extends AppCompatActivity {
    EditText tenTk,mk,tenKh,sdt,diaChi,email;
    Button dangKi;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sigin);
        addControl();
        initControl();
    }

    private void initControl() {
        dangKi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                dangKi();
            }
        });
    }
    public static boolean patternMatches(String emailAddress) {
        String regexPattern = "^(?=.{1,64}@)[A-Za-z0-9_-]+(\\.[A-Za-z0-9_-]+)*@"
                + "[^-][A-Za-z0-9-]+(\\.[A-Za-z0-9-]+)*(\\.[A-Za-z]{2,})$";
        return Pattern.compile(regexPattern)
                .matcher(emailAddress)
                .matches();
    }
    private void dangKi() {

        String str_tenTk = tenTk.getText().toString().trim();
        String str_mk = mk.getText().toString().trim();
        String str_tenKh = tenKh.getText().toString().trim();
        String str_sdt = sdt.getText().toString().trim();
        String str_diaChi = diaChi.getText().toString().trim();
        String str_email = email.getText().toString().trim();
        if (!patternMatches(str_email)) {
            Toast.makeText(getApplicationContext(), "Email chưa đúng định dạng", Toast.LENGTH_SHORT).show();
        }
        else if(TextUtils.isEmpty(str_email))
        {
            Toast.makeText(getApplicationContext(), "Bạn chưa nhập email", Toast.LENGTH_SHORT).show();
        }
        else  if (TextUtils.isEmpty(str_tenTk)) {
            Toast.makeText(getApplicationContext(), "Bạn chưa nhập tên tài khoản", Toast.LENGTH_SHORT).show();
        }
        else if (TextUtils.isEmpty(str_mk)) {
            Toast.makeText(getApplicationContext(), "Bạn chưa nhập mật khẩu", Toast.LENGTH_SHORT).show();
        }
        else if (TextUtils.isEmpty(str_tenKh)) {
            Toast.makeText(getApplicationContext(), "Bạn chưa nhập tên khách hàng", Toast.LENGTH_SHORT).show();
        }
        else if (TextUtils.isEmpty(str_sdt)) {
            Toast.makeText(getApplicationContext(), "Bạn chưa nhập số điện thoại", Toast.LENGTH_SHORT).show();
        }
        else if (TextUtils.isEmpty(str_diaChi)) {
            Toast.makeText(getApplicationContext(), "Bạn chưa nhập địa chỉ", Toast.LENGTH_SHORT).show();
        }
        else {
            StringRequest request = new StringRequest(Request.Method.POST, Server.linkRegister, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    System.out.println(response);
                    if (response.equals("Tạo tài khoản thành công")) {
                        Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
                        startActivity(intent);
                    }
                    else  {
                        Toast.makeText(getApplicationContext(), "Không thành công", Toast.LENGTH_LONG).show();
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {

                }
            }
            ) {
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> map = new HashMap<String, String>();
                    map.put("TenTK", str_tenTk);
                    map.put("MK", str_mk);
                    map.put("TenKH", str_tenKh);
                    map.put("SDT", str_sdt);
                    map.put("DiaChi", str_diaChi);
                    map.put("Email", str_email);
                    return map;
                }
            };
            RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
            queue.add(request);
        }
    }

    private void addControl() {
        tenTk = findViewById(R.id.inputUsername);
        mk = findViewById(R.id.inputPass);
        tenKh = findViewById(R.id.inputName);
        sdt = findViewById(R.id.inputPhone);
        diaChi = findViewById(R.id.inputAdd);
        email = findViewById(R.id.inputEmail);
        dangKi = findViewById(R.id.btnSigin);
    }


}