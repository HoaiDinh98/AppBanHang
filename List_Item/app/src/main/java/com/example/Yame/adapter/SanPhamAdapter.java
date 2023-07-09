package com.example.Yame.adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.icu.text.DecimalFormat;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
//import com.example.list_item.Interface.ItemClickListener;
import com.example.Yame.activity.ChiTietSPActivity;
import com.example.list_item.R;
//import com.example.list_item.model.SanPhamMoi;
import com.example.Yame.ultil.Server;
import com.example.Yame.Model.Item;

import java.util.List;

public class SanPhamAdapter extends RecyclerView.Adapter<SanPhamAdapter.MyViewHolder> {
    Context context;
    List<Item> array;


    public SanPhamAdapter(Context context, List<Item> array) {
        this.context = context;
        this.array = array;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View item = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_sp_trangchu,parent,false);
        return new MyViewHolder(item);
    }

    @SuppressLint("SetTextI18n")
    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        Item sanPhamMoi = array.get(position);
        holder.txtten.setText(sanPhamMoi.getName());
        DecimalFormat decimalFormat = new DecimalFormat("###,###,###");
        holder.txtgia.setText("Giá: "+decimalFormat.format(Double.parseDouble(String.valueOf( sanPhamMoi.getPrice())))+" đ");
        if (sanPhamMoi.getImg().contains("http")){
            Glide.with(context).load(sanPhamMoi.getImg()).into(holder.imghinhanh);
            holder.itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    // Thực hiện hành động khi click được kích hoạt

                    // Chuyển dữ liệu sang màn hình chi tiết sản phẩm
                    Intent intent = new Intent(context, ChiTietSPActivity.class);
                    //Detail detail = new Detail(); // Tạo đối tượng Detail và set giá trị
                    intent.putExtra("chitiet", sanPhamMoi); // Truyền dữ liệu sản phẩm qua Intent
                    intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(intent);
                }
            });

        }else{
            String hinhanh =Server.localhost+"images/"+sanPhamMoi.getImg();
            Glide.with(context).load(hinhanh).into(holder.imghinhanh);
        }


    }

    @Override
    public int getItemCount() {
        return array.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {

        TextView txtgia,txtten,txtMota;
        ImageView imghinhanh;

        public MyViewHolder(@NonNull View itemView) {
            super(itemView);
            txtgia = itemView.findViewById(R.id.itemsp_gia);
            txtten = itemView.findViewById(R.id.itemsp_ten);
            imghinhanh = itemView.findViewById(R.id.itemsp_image);

        }





//        @Override
//        public void onCreateContextMenu(ContextMenu menu, View v, ContextMenu.ContextMenuInfo menuInfo) {
//            menu.add(0,0,getAdapterPosition(),"Sửa");
//            menu.add(0,1,getAdapterPosition(),"Xóa");
//        }


    }

}
