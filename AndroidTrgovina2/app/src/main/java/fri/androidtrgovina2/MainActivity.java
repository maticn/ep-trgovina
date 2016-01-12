package fri.androidtrgovina2;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.Gson;

import android.app.ListActivity;

import fri.androidtrgovina2.model.Izdelki;
import fri.androidtrgovina2.model.IzdelkiMore;

public class MainActivity extends ListActivity {

    public static final String ADDRESS = "http://10.0.2.2/netbeans/trgovina/api/izdelki";
    private static final String TAG = MainActivity.class.getCanonicalName();

    private TextView naslovTV;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //setContentView(R.layout.activity_main);

//        naslovTV = (TextView) findViewById(R.id.pageTitle);
//        naslovTV.setText("Trgovina JKMN - izdelki");

        final RequestQueue queue = Volley.newRequestQueue(this);
        final StringRequest stringRequest = new StringRequest(Request.Method.GET, ADDRESS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        handleResponse(response);
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(MainActivity.this, "An error occurred.", Toast.LENGTH_LONG).show();
                Log.w(TAG, "Exception: " + error.getLocalizedMessage());
            }
        });

        queue.add(stringRequest);
    }

    private void handleResponse(String response) {
        final Gson gson = new Gson();
        final Izdelki[] izdelki = gson.fromJson(response, Izdelki[].class);

        final ArrayAdapter<Izdelki> adapter = new ArrayAdapter<>(this,
                android.R.layout.simple_list_item_1, izdelki);
        setListAdapter(adapter);
    }

    @Override
    protected void onListItemClick(ListView l, View v, int position, long id) {
        final Izdelki izdelek = (Izdelki) getListAdapter().getItem(position);
        final Intent intent = new Intent(this, IzdelkiDetails.class);
        intent.putExtra("izdelekSend", izdelek);
        startActivity(intent);
        //Toast.makeText(BookListActivity.this, "Clicked on " + book, Toast.LENGTH_LONG).show();
    }

}
