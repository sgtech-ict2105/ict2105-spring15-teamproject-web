# ICT2105 Spring 2015 Team Project Web

  * Lim Xing Yi
  * Muhammad Khaleef Mun Seng Bin M A Rajkabul
  * Tan Yeong Chai



<section class="content">
<h1>API Document for inSITe</h1>
<p>RESTful API using the different HTTP methods:</p>
<ul>
  <li><strong>GET</strong> to retrieve and search data</li>
  <li><strong>POST</strong> to add data</li>
  <li><strong>PUT</strong> to update data</li>
  <li><strong>DELETE</strong> to delete data</li>
</ul>

<br />

<h3>REST API Design</h3>
<table width="100%">
	<tr><td><strong>URL Structure</strong></td><td>http://www.metalvilletrading.com.sg/insite/v1/</td></tr>
    <tr><td><strong>API Versioning</strong></td><td>1</td></tr>
    <tr><td><strong>Content Type</strong></td>
    <td>application/json, image/jpeg</td></tr>
    <tr><td><strong>API Key</strong></td><td><strong>Authorization:</strong> 51d3b1d3beb959685da8fa662de3948a</td></tr>
    <tr><td><strong>Web Server</strong></td><td>Apache</td></tr>
    <tr><td><strong>Database</strong></td><td>MySQL</td></tr>
    <tr><td><strong>Language</strong></td><td>PHP</td></tr>
</table>

<br />

<h3>API URL Structure</h3>
<p>You may install the <a href="https://chrome.google.com/webstore/detail/advanced-rest-client/hgmloofddffdnphfgcellkdfbfbjeloo" target="_blank">Chrome Advanced REST client</a> extension on Google Chrome to test the API.</p>
  <table width="100%">
    <tbody>
      <tr>
        <td><strong>URL</strong></td>
        <td><strong>Method</strong></td>
        <td><strong>Parameters</strong></td>
        <td><strong>Description</strong></td>
      </tr>
      <tr>
        <td>http://www.metalvilletrading.com.sg/insite/v1/register</td>
        <td>POST</td>
        <td>name, email, password</td>
        <td>User registration</td>
      </tr>
      <tr>
        <td>http://www.metalvilletrading.com.sg/insite/v1/login</td>
        <td>POST</td>
        <td>email, password</td>
        <td>User login</td>
      </tr>
      <tr>
        <td>http://www.metalvilletrading.com.sg/insite/v1/issue</td>
        <td>POST</td>
        <td><p>issue_name,<br />description,<br />location_name,<br />latitude,<br />longitude,<br />image_path,<br />date_reported,<br />time_reported,<br />urgency_level,<br />reporter,<br />email,<br />mobile</p></td>
        <td>To create new task</td>
      </tr>
      <tr>
        <td>http://www.metalvilletrading.com.sg/insite/v1/issue</td>
        <td>GET</td>
        <td>-</td>
        <td>Fetching all tasks</td>
      </tr>
      <tr>
        <td>http://www.metalvilletrading.com.sg/insite/v1/issue/:id</td>
        <td>GET</td>
        <td>-</td>
        <td>Fetching single task</td>
      </tr>
      <tr>
        <td>http://www.metalvilletrading.com.sg/insite/v1/issue/:id</td>
        <td>PUT</td>
        <td>status, status_comment</td>
        <td>Updating single task</td>
      </tr>
    </tbody>
  </table>

<br />

<h3>HTTP URL Stucture</h3>
<p>The following URL does not requires JSON format as it is accepting MIME Type of <strong>image/jpeg</strong>.</p>
  <table width="100%">
    <tbody>
      <tr>
        <td><strong>URL</strong></td>
        <td><strong>Method</strong></td>
        <td><strong>Parameters</strong></td>
        <td><strong>Description</strong></td>
      </tr>
      <tr>
        <td>http://www.metalvilletrading.com.sg/insite/v1/image</td>
        <td>POST</td>
        <td>Image file</td>
        <td>Upload image</td>
      </tr>
    </tbody>
  </table>

<br />

<h3>HTTP Status Code</h3>
<table width="100%">
  <tbody>
    <tr>
      <td><strong>200</strong></td>
      <td>OK</td>
    </tr>
    <tr>
      <td><strong>201</strong></td>
      <td>Created</td>
    </tr>
    <tr>
      <td><strong>304</strong></td>
      <td>Not Modified</td>
    </tr>
    <tr>
      <td><strong>400</strong></td>
      <td>Bad Request</td>
    </tr>
    <tr>
      <td><strong>401</strong></td>
      <td>Unauthorized</td>
    </tr>
    <tr>
      <td><strong>403</strong></td>
      <td>Forbidden</td>
    </tr>
    <tr>
      <td><strong>404</strong></td>
      <td>Not Found</td>
    </tr>
    <tr>
      <td><strong>422</strong></td>
      <td>Unprocessable Entity</td>
    </tr>
    <tr>
      <td><strong>500</strong></td>
      <td>Internal Server Error</td>
    </tr>
  </tbody>
</table>
<br />
<p>Last modified by <strong>Lim Xing Yi</strong> on 28 March 2015.</p>

</section>

