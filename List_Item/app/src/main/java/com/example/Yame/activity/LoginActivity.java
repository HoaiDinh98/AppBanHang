package com.example.Yame.activity;

import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.Yame.Model.User;
import com.example.Yame.ultil.Server;
import com.example.list_item.R;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {
    EditText tentk,matkhau;
    TextView dangKi;
    Button login;
    String str_tenTk, str_mk;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        addControl();
        initControl();
    }

    //
    private void initControl() {
        dangKi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), RegisterActivity.class);
                startActivity(intent);
            }
        });
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                str_tenTk = tentk.getText().toString().trim();
                str_mk = matkhau.getText().toString().trim();

                if(TextUtils.isEmpty(str_tenTk))
                {
                    Toast.makeText(getApplicationContext(), "Bạn chưa nhập tên tài khoản", Toast.LENGTH_SHORT).show();
                } else if (TextUtils.isEmpty(str_mk)) {
                    Toast.makeText(getApplicationContext(), "Bạn chưa nhập mật khẩu", Toast.LENGTH_SHORT).show();
                }
                else {
                    StringRequest request = new StringRequest(Request.Method.POST, Server.linkLogin, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            Toast.makeText(getApplicationContext(), response, Toast.LENGTH_LONG).show();
                            System.out.println(response);
                            if (response.equals("Đăng nhập thành công"))
                            {
                                Server.user_current.setTk(str_tenTk);
                                Intent intent = new Intent(getApplicationContext(),frmTrangChu.class);
                                startActivity(intent);
                            }
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
                            map.put("TenTK",str_tenTk);
                            map.put("MK",str_mk);
                            return map;
                        }
                    };
                    RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
                    queue.add(request);
                }
            }
        });
    }



    public void addControl()
    {
        tentk = (EditText) findViewById(R.id.inputUsername);
        matkhau = (EditText) findViewById(R.id.inputPass);
        login = (Button) findViewById(R.id.btnLogin);
        dangKi = (TextView) findViewById(R.id.txtSigin);

        if(Server.user_current == null) {
            Server.user_current = new User();
        }
    }
}