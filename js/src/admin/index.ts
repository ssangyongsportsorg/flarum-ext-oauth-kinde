import app from 'flarum/admin/app';
import { ConfigureWithOAuthPage } from '@fof-oauth';

app.initializers.add('umhelper/oauth-clerk', () => {
  app.extensionData.for('umhelper-oauth-clerk').registerPage(ConfigureWithOAuthPage);
});
