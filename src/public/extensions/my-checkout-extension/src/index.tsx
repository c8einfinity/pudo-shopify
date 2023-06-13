import React from 'react';
import {
  useExtensionApi,
  render,
  Banner,
  useTranslate,
} from '@shopify/checkout-ui-extensions-react';

render('Checkout::Dynamic::Render', () => <App />);

function App() {
  const {extensionPoint} = useExtensionApi();
  const translate = useTranslate();
  return (
    <Banner title="my-checkout-extension">
      {"<h1>Hello World! 111 222 2555</h1>"}
      {translate('welcome', {extensionPoint})}
    </Banner>
  );
}