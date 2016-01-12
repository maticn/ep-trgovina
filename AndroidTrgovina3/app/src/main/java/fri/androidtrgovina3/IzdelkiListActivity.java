package fri.androidtrgovina3;

import android.app.ListActivity;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
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

import fri.androidtrgovina3.model.Izdelki;
import fri.androidtrgovina3.model.IzdelkiMore;

public class IzdelkiListActivity extends ListActivity {

    public static final String ADDRESS = "http://10.0.2.2/netbeans/trgovina/api/izdelki";
    private static final String TAG = IzdelkiListActivity.class.getCanonicalName();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_izdelki_list);

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
                Toast.makeText(IzdelkiListActivity.this, "An error occurred.", Toast.LENGTH_LONG).show();
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
        final Intent intent = new Intent(this, IzdelkiDetailActivity.class);
        intent.putExtra("izdelekSend", izdelek);
        startActivity(intent);
        //Toast.makeText(BookListActivity.this, "Clicked on " + book, Toast.LENGTH_LONG).show();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_izdelki_list, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

}
