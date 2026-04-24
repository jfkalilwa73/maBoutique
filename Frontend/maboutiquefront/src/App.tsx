import { useAppViewModel } from './application/useAppViewModel'
import { AppNav } from './views/AppNav'
import { PageView } from './views/PageView'
import './App.css'

function App() {
  const viewModel = useAppViewModel()

  return (
    <div className="app">
      {viewModel.activePage !== 'connexion' && (
        <AppNav
          activePage={viewModel.activePage}
          isAuthenticated={viewModel.isAuthenticated}
          onNavigate={viewModel.navigate}
          onLogout={viewModel.logout}
        />
      )}
      <PageView viewModel={viewModel} />
    </div>
  )
}

export default App
