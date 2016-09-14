		<form id="login" class="login modal" action="api/login.php" method="POST">
          <div class="row">
            <label>Email</label><br/>
            <input type="text" placeholder="enter your email" name="email"/>
          </div>
          <div class="row">
            <label>Password</label><br/>
            <input type="password" placeholder="enter your password" name="password"/>
          </div>
          <div class="row">
            <button class="btn" type="submit">Login</button>
          </div>
        </form>

        <form id="register" class="login modal" action="api/register.php" method="POST">
          <div class="row">
            <label>Name</label><br/>
            <input type="text" placeholder="enter your name" name="name"/>
          </div>
          <div class="row">
            <label>Email</label><br/>
            <input type="text" placeholder="enter your email" name="email"/>
          </div>
          <div class="row">
            <label>Password</label><br/>
            <input type="password" placeholder="enter your password" name="password"/>
          </div>
          <div class="row">
            <label>Confirm Password</label><br/>
            <input type="password" placeholder="enter your password again" name="password2"/>
          </div>
          <!-- <div class="row">
            <label>Type</label><br/><br/>
            <select name="type">
              <option value="user">User</option>
              <option value="provider">Provider</option>
            </select>
          </div>
          <br/> -->
          <div class="row">
            <button class="btn" type="submit">Sign Up</button>
          </div>
        </form>
        <!-- end: wrapper -->
  			<div class="push"></div>
  		</div>
  		<footer>
        <div class="row-fixed">         
          <ul>
            <li><a href="#">Help</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">TOS</a></li>
          </ul>
          <span>All rights reserved. Copyright &copy; <?php echo date('Y'); ?>.</span>
        </div>
  		</footer>	      
	</body>
</html>