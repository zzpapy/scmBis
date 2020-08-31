import {render, unmountComponentAtNode} from "react-dom"
import React, {useEffect,useCallback} from "react"
import { usePaginatedFetch, useFetch } from './hooks'
import {Icon} from '../components/Icon'
import StripeCheckoutButton from '../components/stripe.button.component'

const Toto = React.memo(({scm}) => {
    console.log(scm)
 return <p>{scm.nom}</p>
})

function Title({count}){
    return <h3>
        <Icon icon="comments" />
        {count} Commentaire{count > 1 ? 's': ''} </h3>
}
function Test () {
    const {items : scms,setItems: setComments, load,loading,setCount, count,hasMore} = usePaginatedFetch('/api/scms')
    useEffect(() =>{
        load()        
    },[])
    const totalPrice = 58
    return <div>
        <Title count={count} />
        {console.log(count)}
        {loading && 'chargement...'}
        {scms.map((scm) => <Toto scm={scm} key={scm.id}/>)}
        <StripeCheckoutButton price={totalPrice} />
        {console.log(totalPrice)}
        </div>
    
}


class TestElement extends HTMLElement{
    
    connectedCallback(){
       render( <Test />, this)
    }

    // disconnectedCallBack (){
    //     unmountComponentAtNode(this)
    // }
}

customElements.define('test-test',TestElement)