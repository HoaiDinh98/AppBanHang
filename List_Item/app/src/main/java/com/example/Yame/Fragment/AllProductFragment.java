package com.example.Yame.Fragment;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.example.Yame.Model.Item;
import com.example.Yame.Model.Item;
import com.example.list_item.R;
import com.example.Yame.adapter.SanPhamAdapter;
import com.example.Yame.ultil.Server;
import com.example.Yame.ultil.checkConnection;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;


public class AllProductFragment extends Fragment {

    Context context;
    RecyclerView recyclerView;
    ArrayList<Item> arr;
    SanPhamAdapter adapter;
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        super.onCreateView(inflater,container,savedInstanceState);
        View view = inflater.inflate(R.layout.fragment_short, container, false);


        recyclerView = (RecyclerView)view.findViewById(R.id.recyclerViewShort);
        GetDungREcyle(recyclerView);
        getDataProduct2();

        return view;
    }
    private  void GetDungREcyle(RecyclerView temp){
        RecyclerView.LayoutManager layoutManager = new GridLayoutManager(getActivity(),2);
        temp.setLayoutManager(layoutManager);
    }
    private void getDataProduct2(){
        arr = new ArrayList<>();
        adapter = new SanPhamAdapter(getActivity(),arr);
        recyclerView.setAdapter(adapter);
        RequestQueue requestQueue = Volley.newRequestQueue(getActivity());
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, Server.linkproductShort,null, new Response.Listener<JSONArray>() {
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
                checkConnection.ShowToast(getParentFragment().getContext(), error.toString());
            }
        });
        requestQueue.add(jsonArrayRequest);
    }

}