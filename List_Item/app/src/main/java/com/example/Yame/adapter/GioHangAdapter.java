package com.example.Yame.adapter;

import android.content.Context;
import android.content.DialogInterface;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.appcompat.app.AlertDialog;

import com.example.Yame.Model.GioHang;
import com.example.Yame.activity.GioHangActivity;
import com.example.Yame.activity.MainActivity;
import com.example.list_item.R;
import com.squareup.picasso.Picasso;

import java.text.DecimalFormat;
import java.util.ArrayList;

public class GioHangAdapter extends BaseAdapter {
    Context context;
    ArrayList<GioHang> arrayListGioHang;

    public GioHangAdapter(Context context, ArrayList<GioHang> arrayListGioHang) {
        this.context = context;
        this.arrayListGioHang = arrayListGioHang;
    }

    @Override
    public int getCount() {
        return arrayListGioHang.size();
    }

    @Override
    public Object getItem(int position) {
        return arrayListGioHang.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }
    public class ViewHolder {
     public TextView txtTenGioHang, txtGiaGioHang;
     public ImageView imgGioHang;
     public Button btnLeft, btnValue, btnRight;
    }
    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
      ViewHolder viewHolder;
      if(convertView == null) {
          viewHolder = new ViewHolder();
          LayoutInflater inflater= (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
          convertView = inflater.inflate(R.layout.item_giohang,null);
          viewHolder.txtTenGioHang = convertView.findViewById(R.id.textviewtenmonhang);
          viewHolder.txtGiaGioHang = convertView.findViewById(R.id.textviewgiamonhang);
          viewHolder.imgGioHang = convertView.findViewById(R.id.imgGioHang);
          viewHolder.btnLeft = convertView.findViewById(R.id.btnGiam);
          viewHolder.btnValue = convertView.findViewById(R.id.btnSL);
          viewHolder.btnRight = convertView.findViewById(R.id.btnTang);
          convertView.setTag(viewHolder);
      } else {
          viewHolder= (ViewHolder) convertView.getTag();
      }
        GioHang giohang= (GioHang) getItem(position);
        viewHolder.txtTenGioHang.setText(giohang.getTenSP());
        DecimalFormat decimalFormat = new DecimalFormat("###,###,###");
        viewHolder.txtGiaGioHang.setText("Giá: "+ decimalFormat.format(giohang.getDonGia())+"VNĐ");
        Picasso.get().load(giohang.getAnhSP())
                .placeholder(R.drawable.loading)
                .error(R.drawable.error)
                .into(viewHolder.imgGioHang);
        viewHolder.btnValue.setText(giohang.getSoLuong()+"");

        final int sl= Integer.parseInt(viewHolder.btnValue.getText().toString());
        if(sl >= 10) {
            viewHolder.btnRight.setVisibility(View.INVISIBLE);
            viewHolder.btnLeft.setVisibility(View.VISIBLE);
        } else if(sl >= 1) {
            viewHolder.btnLeft.setVisibility(View.VISIBLE);
            viewHolder.btnRight.setVisibility(View.VISIBLE);
        }

        final ViewHolder finalViewHolder = viewHolder;
        viewHolder.btnRight.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int slmoinhat = Integer.parseInt(finalViewHolder.btnValue.getText().toString())+1;
                int slhientai = MainActivity.manggiohang.get(position).getSoLuong();
                int giaht = MainActivity.manggiohang.get(position).getDonGia();
                MainActivity.manggiohang.get(position).setSoLuong(slmoinhat);
                int giamoinhat = (giaht*slmoinhat)/slhientai;
                MainActivity.manggiohang.get(position).setDonGia(giamoinhat);
                DecimalFormat decimalFormat = new DecimalFormat("###,###,###");
                finalViewHolder.txtGiaGioHang.setText("Giá: "+ decimalFormat.format(giamoinhat)+"VNĐ");
                GioHangActivity.evenUltil();
                if (slmoinhat > 9){
                    finalViewHolder.btnRight.setVisibility(View.INVISIBLE);
                    finalViewHolder.btnLeft.setVisibility(View.VISIBLE);
                    finalViewHolder.btnValue.setText(String.valueOf(slmoinhat));
                } else {
                    finalViewHolder.btnRight.setVisibility(View.VISIBLE);
                    finalViewHolder.btnLeft.setVisibility(View.VISIBLE);
                    finalViewHolder.btnValue.setText(String.valueOf(slmoinhat));
                }
            }
        });

        viewHolder.btnLeft.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int slmoinhat = Integer.parseInt(finalViewHolder.btnValue.getText().toString())-1;

                if(slmoinhat < 1){
                    AlertDialog.Builder builder=new AlertDialog.Builder(v.getRootView().getContext());
                    builder.setTitle("Thông báo !!");
                    builder.setMessage("Bạn có chắc chắn xóa sản phẩm này");
                    builder.setPositiveButton("Có", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            int slhientai = MainActivity.manggiohang.get(position).getSoLuong();
                            int giaht = MainActivity.manggiohang.get(position).getDonGia();
                            MainActivity.manggiohang.get(position).setSoLuong(slmoinhat);
                            int giamoinhat = (giaht*slmoinhat)/slhientai;
                            MainActivity.manggiohang.get(position).setDonGia(giamoinhat);
                            DecimalFormat decimalFormat = new DecimalFormat("###,###,###");
                            finalViewHolder.txtGiaGioHang.setText("Giá: "+ decimalFormat.format(giamoinhat)+"VNĐ");
                            GioHangActivity.evenUltil();
                            MainActivity.manggiohang.remove(position);
                            notifyDataSetChanged();
                        }
                    });
                    builder.setNegativeButton("Không", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            dialog.dismiss();
                        }
                    });
                    builder.show();
                }else{
                    int slhientai = MainActivity.manggiohang.get(position).getSoLuong();
                    int giaht = MainActivity.manggiohang.get(position).getDonGia();
                    MainActivity.manggiohang.get(position).setSoLuong(slmoinhat);
                    int giamoinhat = (giaht*slmoinhat)/slhientai;
                    MainActivity.manggiohang.get(position).setDonGia(giamoinhat);
                    DecimalFormat decimalFormat = new DecimalFormat("###,###,###");
                    finalViewHolder.txtGiaGioHang.setText("Giá: "+ decimalFormat.format(giamoinhat)+"VNĐ");
                    GioHangActivity.evenUltil();

                    finalViewHolder.btnRight.setVisibility(View.VISIBLE);
                    finalViewHolder.btnLeft.setVisibility(View.VISIBLE);
                    finalViewHolder.btnValue.setText(String.valueOf(slmoinhat));
                }

            }
        });
        return convertView;
    }
}
