package com.example.Yame.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.Yame.Model.Item;
import com.example.list_item.R;
import com.squareup.picasso.Picasso;

import java.text.DecimalFormat;
import java.util.ArrayList;

public class AdapterItem extends BaseAdapter {
    Context context;
    ArrayList<Item> array;

    public AdapterItem(Context context, ArrayList<Item> array) {
        this.context = context;
        this.array = array;
    }

    @Override
    public int getCount() {
        return array.size();
    }

    @Override
    public Object getItem(int i) {
        return array.get(i);
    }

    @Override
    public long getItemId(int i) {
        return i;
    }
    public class ViewHolder{
        public TextView txtName, txtPrice;
        public ImageView imgItem;
    }
    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        ViewHolder viewHolder = null;
        if(viewHolder == null){
            viewHolder = new ViewHolder();
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.layout_item, null);
            viewHolder.txtName = view.findViewById(R.id.textName);
            viewHolder.txtPrice = view.findViewById(R.id.priceItem);
            viewHolder.imgItem = view.findViewById(R.id.imgItem);
            view.setTag(viewHolder);

        }else{
            viewHolder = (ViewHolder) view.getTag();
        }
        Item item = (Item) getItem(i);
        viewHolder.txtName.setText(item.getName());
        DecimalFormat df =new DecimalFormat("#,###");
        int n = item.getPrice();
        String formattedNumberWithComma = df.format(n);
        viewHolder.txtPrice.setText(formattedNumberWithComma + " vnđ");
        //viewHolder.imgItem.setImageURI(Uri.parse(item.getImg()));
        Picasso.get().load(item.getImg())
                .into(viewHolder.imgItem);
        return view;
    }
}
