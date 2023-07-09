package com.example.Yame.activity;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import androidx.appcompat.widget.Toolbar;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.Yame.Model.Item;
import com.example.Yame.adapter.AdapterItem;
import com.example.Yame.adapter.SanPhamAdapter;
import com.example.Yame.ultil.Server;
import com.example.Yame.ultil.checkConnection;
import com.example.list_item.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class SearchActivity extends AppCompatActivity {

    Toolbar toolbar;
    RecyclerView recyclerView;
    SanPhamAdapter adapter;
    ArrayList<Item> arr;
    EditText edtSearch;
    Button btn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search);
        initView();
        //ActionBar();
        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getDataProduct();
            }
        });

    }

    private void initView() {
        //toolbar = findViewById(R.id.toolbar);
        recyclerView = findViewById(R.id.recyclerSearch);
        LinearLayoutManager layoutManager = new LinearLayoutManager(this);
        recyclerView.setHasFixedSize(true);
        recyclerView.setLayoutManager(layoutManager);
        edtSearch = findViewById(R.id.edtSearch);
        btn = findViewById(R.id.btnSearch);
    }

    private void ActionBar() {
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(false);
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }

    private void getDataProduct(){
        arr = new ArrayList<>();
        adapter = new SanPhamAdapter(SearchActivity.this,arr);
        recyclerView.setAdapter(adapter);
        RequestQueue requestQueue = Volley.newRequestQueue(SearchActivity.this);
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, Server.linkSearch,null, new Response.Listener<JSONArray>() {
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
                            id = jsonObject.getInt("MaSp");
                            name = jsonObject.getString("TenSP");
                            img = jsonObject.getString("HinhAnh");
                            price = jsonObject.getInt("DonGia");
                            detail = jsonObject.getString("ChiTiet");

                            arr.add(new Item(id,name,img,price,detail));
                            adapter.notifyDataSetChanged();
                        } catch (JSONException e) {
//                            Toast.makeText(frmTrangChu.this, "1", Toast.LENGTH_SHORT).show();
                            throw new RuntimeException(e);
                        }
                    }
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                checkConnection.ShowToast(SearchActivity.this,error.toString());
            }
        }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                HashMap<String,String> hashMap= new HashMap<String,String>();
                hashMap.put("search",edtSearch.getText().toString());
                return hashMap;
            }
        };
        requestQueue.add(jsonArrayRequest);
    }
}